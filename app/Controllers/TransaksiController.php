<?php

namespace App\Controllers;

class TransaksiController extends BaseController
{
    protected $transaksiModel;
    protected $karyawanModel;
    protected $pelangganModel;
    protected $menuModel;
    protected $session;
    protected $data = [];

    public function __construct()
    {
        $this->transaksiModel = new \App\Models\TransaksiModel();
        $this->voucherModel = new \App\Models\VoucherModel();
        $this->karyawanModel = new \App\Models\KaryawanModel();
        $this->pelangganModel = new \App\Models\PelangganModel();
        $this->menuModel = new \App\Models\MenuModel();
        $this->session = \Config\Services::session();

        $this->data['session'] = $this->session;
    }

    public function detail($id)
    {
        $transactionDetails = $this->transaksiModel->getTransactionDetail($id);

        if (empty($transactionDetails)) {
            $this->session->setFlashdata('error', 'Transaksi tidak ditemukan');
            return redirect()->to(base_url('transaksi'));
        }

        // Inisialisasi MenuModel jika belum
        $menuModel = new \App\Models\MenuModel();

        // Loop melalui detail transaksi dan cek menu
        foreach ($transactionDetails as &$detail) {
            if (is_null($detail['id_menu']) || !$menuModel->find($detail['id_menu'])) {
                $detail['menu_dihapus'] = true;
            } else {
                $detail['menu_dihapus'] = false;
            }
        }

        $this->data['title'] = 'Detail Transaksi';
        $this->data['transaction'] = $transactionDetails;

        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('transaksi/detail', $this->data)
            . view('layout/footer', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Tambah Transaksi';
        $this->data['karyawan'] = $this->karyawanModel->select('id_karyawan as id, nama_karyawan as nama')->findAll();
        $this->data['pelanggan'] = $this->pelangganModel->select('id_pelanggan as id, nama_pelanggan as nama')->findAll();
        $this->data['menu'] = $this->menuModel->select('id_menu as id, nama_menu, harga_menu')->findAll();

        // Tambahkan kode berikut untuk mengambil data voucher
        $this->voucherModel = new \App\Models\VoucherModel();
        $this->data['vouchers'] = $this->voucherModel->select('kode_voucher, diskon')->findAll();

        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('transaksi/create', $this->data)
            . view('layout/footer', $this->data);
    }

    public function store()
    {
        if (
            !$this->validate([
                'id_karyawan' => 'required',
                'id_pelanggan' => 'required',
                'menu' => 'required',
                'quantity' => 'required',
                'pembayaran' => 'required|numeric|greater_than[0]',
                'diskon' => 'permit_empty|numeric',
                'kode_voucher' => 'permit_empty',
                'kembalian' => 'required|numeric'
            ])
        ) {
            $this->session->setFlashdata('error', 'Validasi gagal');
            return redirect()->back()->withInput();
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Generate unique id_transaksi
            $id_transaksi = $this->transaksiModel->generateIdTransaksi();

            // Ambil data dari form
            $pembayaran = intval($this->request->getPost('pembayaran'));
            $kembalian = intval($this->request->getPost('kembalian'));
            $totalHarga = intval($this->request->getPost('total_harga'));
            $kodeVoucher = $this->request->getPost('kode_voucher');

            // Definisikan $transaksiData
            $transaksiData = [
                'id_transaksi' => $id_transaksi,
                'id_karyawan' => $this->request->getPost('id_karyawan'),
                'id_pelanggan' => $this->request->getPost('id_pelanggan'),
                'kode_voucher' => $kodeVoucher ?: null,
                'harga_total' => $totalHarga,
                'pembayaran' => $pembayaran,
                'kembalian' => $kembalian
            ];

            // Simpan transaksi
            $this->transaksiModel->insert($transaksiData);

            // **Tambahkan Kode Berikut untuk Menyimpan Detail Transaksi**
            $menuItems = $this->request->getPost('menu');
            $quantities = $this->request->getPost('quantity');

            foreach ($menuItems as $key => $menuId) {
                $menu = $this->menuModel->withDeleted()->find($menuId);
                $detailData = [
                    'id_transaksi' => $id_transaksi,
                    'id_menu' => $menuId,
                    'nama_menu' => $menu['nama_menu'], // Tambahkan ini
                    'jumlah_produk' => $quantities[$key],
                    'harga_satuan' => $menu['harga_menu'],
                    'harga_total' => $menu['harga_menu'] * $quantities[$key],
                ];
                $db->table('detailtransaksi')->insert($detailData);
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menyimpan transaksi');
            }

            $this->session->setFlashdata('success', 'Transaksi berhasil disimpan');
            return redirect()->to(base_url('transaksi'));

        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }




    public function index()
    {
        $this->data['title'] = 'Daftar Transaksi';
        $this->data['transaksi'] = $this->transaksiModel->findAll();

        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('transaksi/index', $this->data)
            . view('layout/footer', $this->data);
    }

    public function validateVoucher()
    {
        if ($this->request->isAJAX()) {
            $kodeVoucher = $this->request->getJSON()->kode_voucher;

            // Load the VoucherModel
            $voucherModel = new \App\Models\VoucherModel();
            $voucher = $voucherModel->where('kode_voucher', $kodeVoucher)->first();

            if ($voucher) {
                return $this->response->setJSON([
                    'success' => true,
                    'diskon' => $voucher['diskon']
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Kode voucher tidak valid'
                ]);
            }
        } else {
            throw new \Exception('Invalid request');
        }
    }
}