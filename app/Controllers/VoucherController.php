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
        // Generate kode voucher
        $prefix = 'VCR';
        $date = date('Ymd');
        $lastVoucher = $this->voucherModel->orderBy('kode_voucher', 'DESC')->first();
        
        if ($lastVoucher) {
            $lastNumber = substr($lastVoucher['kode_voucher'], -3);
            $nextNumber = str_pad((int)$lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '001';
        }
        
        $kode_voucher = $prefix . $date . $nextNumber;
        
        $data = [
            'title' => 'Tambah Voucher',
            'kode_voucher' => $kode_voucher
        ];
        
        return view('voucher/create', $data);
    }

    public function store()
    {
        // Validasi input
        $rules = [
            'kode_voucher' => 'required|min_length[5]|is_unique[voucher.kode_voucher]',
            'jumlah_poin' => 'required|numeric|greater_than[0]'
        ];
    
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal');
        }
    
        try {
            $data = [
                'kode_voucher' => $this->request->getPost('kode_voucher'),
                'jumlah_poin' => $this->request->getPost('jumlah_poin')
            ];
    
            $this->voucherModel->insert($data);
            return redirect()->to('voucher')->with('success', 'Voucher berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan voucher: ' . $e->getMessage());
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