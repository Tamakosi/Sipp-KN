<?php

namespace App\Controllers;

use App\Models\VoucherModel;
use App\Models\TransaksiModel;

class VoucherController extends BaseController
{
    protected $voucherModel;
    protected $transaksiModel;
    protected $session;
    protected $data = [];

    public function __construct()
    {
        $this->voucherModel = new VoucherModel();
        $this->transaksiModel = new TransaksiModel();
        $this->session = \Config\Services::session();
        $this->data['session'] = $this->session;
    }

    public function index()
    {
        $this->data['title'] = 'Data Voucher';
        $this->data['vouchers'] = $this->voucherModel->findAll();

        return view('layout/header', $this->data)
             . view('layout/topbar', $this->data)
             . view('layout/sidebar', $this->data)
             . view('voucher/index', $this->data)
             . view('layout/footer', $this->data);
    }

    public function history($kode_voucher)
    {
        // Dapatkan detail voucher
        $voucher = $this->voucherModel->find($kode_voucher);

        if (!$voucher) {
            $this->session->setFlashdata('error', 'Voucher tidak ditemukan');
            return redirect()->to(base_url('voucher'));
        }

        // Dapatkan transaksi yang menggunakan voucher ini
        $transactions = $this->transaksiModel->getTransaksiByVoucher($kode_voucher);

        $this->data['title'] = 'Riwayat Pemakaian Voucher';
        $this->data['voucher'] = $voucher;
        $this->data['transactions'] = $transactions;

        return view('layout/header', $this->data)
             . view('layout/topbar', $this->data)
             . view('layout/sidebar', $this->data)
             . view('voucher/history', $this->data)
             . view('layout/footer', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Tambah Voucher';
        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('voucher/create', $this->data)
            . view('layout/footer', $this->data);
    }

    public function store()
    {
        if (!$this->validate($this->voucherModel->getValidationRules(), $this->voucherModel->getValidationMessages())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'kode_voucher' => $this->request->getPost('kode_voucher'),
            'diskon'       => $this->request->getPost('diskon')
        ];

        try {
            $this->voucherModel->insert($data);
            $this->session->setFlashdata('success', 'Voucher berhasil ditambahkan');
            return redirect()->to(base_url('voucher'));
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Gagal menyimpan voucher: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($kode_voucher)
    {
        $voucher = $this->voucherModel->find($kode_voucher);
        if (!$voucher) {
            $this->session->setFlashdata('error', 'Voucher tidak ditemukan');
            return redirect()->to(base_url('voucher'));
        }

        $this->data['title'] = 'Edit Voucher';
        $this->data['voucher'] = $voucher;

        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('voucher/edit', $this->data)
            . view('layout/footer', $this->data);
    }

    public function update($kode_voucher)
    {
        if (!$this->validate($this->voucherModel->getValidationRules())) {
            $this->session->setFlashdata('error', 'Validasi gagal');
            return redirect()->back()->withInput();
        }

        $data = [
            'diskon' => $this->request->getPost('diskon')
        ];

        $this->voucherModel->update($kode_voucher, $data);
        $this->session->setFlashdata('success', 'Voucher berhasil diperbarui');
        return redirect()->to(base_url('voucher'));
    }

    public function delete($kode_voucher)
    {
        $this->voucherModel->delete($kode_voucher);
        $this->session->setFlashdata('success', 'Voucher berhasil dihapus');
        return redirect()->to(base_url('voucher'));
    }
}