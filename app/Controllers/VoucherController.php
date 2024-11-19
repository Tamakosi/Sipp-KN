<?php

namespace App\Controllers;

use App\Models\VoucherModel;
use CodeIgniter\RESTful\ResourceController;

class VoucherController extends ResourceController
{
    protected $voucherModel;

    public function __construct()
    {
        $this->voucherModel = new VoucherModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Voucher',
            'voucher' => $this->voucherModel->findAll()
        ];

        return view('voucher/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Voucher'
        ];

        return view('voucher/create', $data);
    }

    public function store()
    {
        if (!$this->validate($this->voucherModel->validationRules, $this->voucherModel->validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'kode_voucher' => $this->request->getPost('kode_voucher'),
            'jumlah_poin' => $this->request->getPost('jumlah_poin')
        ];

        try {
            $this->voucherModel->insert($data);
            return redirect()->to('voucher')->with('success', 'Voucher berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function edit($kodeVoucher = null)
    {
        $voucher = $this->voucherModel->find($kodeVoucher);
        
        if (!$voucher) {
            return redirect()->to('voucher')->with('error', 'Voucher tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Voucher',
            'voucher' => $voucher
        ];

        return view('voucher/edit', $data);
    }

    public function update($kodeVoucher = null)
    {
        if (!$this->validate($this->voucherModel->validationRules, $this->voucherModel->validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'jumlah_poin' => $this->request->getPost('jumlah_poin')
        ];

        try {
            $this->voucherModel->update($kodeVoucher, $data);
            return redirect()->to('voucher')->with('success', 'Voucher berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    public function delete($kodeVoucher = null)
    {
        try {
            if ($this->voucherModel->delete($kodeVoucher)) {
                return redirect()->to('voucher')->with('success', 'Voucher berhasil dihapus');
            }
            return redirect()->to('voucher')->with('error', 'Voucher tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->to('voucher')->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    public function view($kodeVoucher = null)
    {
        $voucher = $this->voucherModel->find($kodeVoucher);
        
        if (!$voucher) {
            return redirect()->to('voucher')->with('error', 'Voucher tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Voucher',
            'voucher' => $voucher
        ];

        return view('voucher/view', $data);
    }

    public function search()
    {
        $keyword = $this->request->getGet('search');
        
        $data = [
            'title' => 'Data Voucher',
            'voucher' => $this->voucherModel->like('kode_voucher', $keyword)
                                          ->orLike('jumlah_poin', $keyword)
                                          ->findAll()
        ];

        return view('voucher/index', $data);
    }
}