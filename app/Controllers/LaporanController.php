<?php

namespace App\Controllers;

use App\Models\TransaksiModel;

class LaporanController extends BaseController
{
    protected $transaksiModel;
    protected $session;
    protected $data = [];
    // Add this line

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();

        // Initialize the session
        $this->session = \Config\Services::session();

        // Assign session to data array for use in views
        $this->data['session'] = $this->session;
    }


    public function penjualan()
    {
        $this->data['title'] = 'Laporan Penjualan';

        // Mengambil parameter tanggal dari GET
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        // Meneruskan parameter tanggal ke view
        $this->data['start_date'] = $start_date;
        $this->data['end_date'] = $end_date;

        // Mengambil data laporan penjualan dengan filter tanggal
        $this->data['laporan'] = $this->transaksiModel->getLaporanPenjualan($start_date, $end_date);

        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('laporan/penjualan', $this->data)
            . view('layout/footer', $this->data);
    }

    public function cetak($id_transaksi)
    {
        $transaksi = $this->transaksiModel->getTransactionDetail($id_transaksi);

        if (empty($transaksi)) {
            $this->session->setFlashdata('error', 'Transaksi tidak ditemukan');
            return redirect()->to(base_url('laporan/penjualan'));
        }

        // Ambil detail transaksi
        $detail_transaksi = $transaksi;

        // Ambil informasi tambahan dari transaksi
        $data = [
            'title' => 'Cetak Transaksi',
            'transaksi' => $transaksi[0], // Ambil data transaksi pertama
            'detail_transaksi' => $detail_transaksi,
        ];

        return view('laporan/cetak', $data);
    }

    public function cetakSemua()
    {
        $title = 'Cetak Laporan Penjualan';

        // Mengambil parameter tanggal dari GET
        $start_date = $this->request->getGet('start_date');
        $end_date = $this->request->getGet('end_date');

        // Mengambil data laporan penjualan
        $laporan = $this->transaksiModel->getLaporanPenjualan($start_date, $end_date);

        $data = [
            'title' => $title,
            'laporan' => $laporan,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ];

        return view('laporan/cetaksemua', $data);
    }
}
