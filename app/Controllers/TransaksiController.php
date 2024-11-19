<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\KaryawanModel;
use App\Models\PelangganModel;
use App\Models\VoucherModel;

class TransaksiController extends BaseController
{
    protected $transaksiModel;
    protected $karyawanModel;
    protected $pelangganModel;
    protected $voucherModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->karyawanModel = new KaryawanModel();
        $this->pelangganModel = new PelangganModel();
        $this->voucherModel = new VoucherModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Transaksi',
            'transaksi' => $this->transaksiModel->getTransaksiWithRelations()
        ];

        return view('transaksi/index', $data);
    }

    public function detail($id)
    {
        $transaksi = $this->transaksiModel->find($id);
        
        if (!$transaksi) {
            return redirect()->to('transaksi')->with('error', 'Transaksi tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Transaksi',
            'transaksi' => $transaksi
        ];

        return view('transaksi/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Transaksi',
            'karyawan' => $this->karyawanModel->findAll(),
            'pelanggan' => $this->pelangganModel->findAll(),
            'voucher' => $this->voucherModel->findAll()
        ];

        return view('transaksi/create', $data);
    }

    public function delete($id)
    {
        try {
            $this->transaksiModel->delete($id);
            session()->setFlashdata('success', 'Transaksi berhasil dihapus');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menghapus transaksi');
        }
        return redirect()->to(base_url('transaksi'));
    }

    public function store()
    {
        // Validasi input
        $rules = [
            'id_karyawan' => 'required',
            'id_pelanggan' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_karyawan' => $this->request->getPost('id_karyawan'),
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'kode_voucher' => $this->request->getPost('kode_voucher')
        ];

        try {
            $this->transaksiModel->insert($data);
            return redirect()->to('transaksi')->with('success', 'Transaksi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }
}