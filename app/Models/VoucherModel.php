<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table = 'kodevoucher';  // Ubah nama tabel
    protected $primaryKey = 'kode_voucher';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['kode_voucher', 'jumlah_poin'];
    protected $returnType = 'array';

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'kode_voucher' => 'required|min_length[3]|max_length[20]|is_unique[kodevoucher.kode_voucher,kode_voucher,{kode_voucher}]',
        'jumlah_poin'  => 'required|numeric|greater_than[0]'
    ];
    
    protected $validationMessages = [
        'kode_voucher' => [
            'required'    => 'Kode voucher harus diisi',
            'min_length'  => 'Kode voucher minimal 3 karakter',
            'max_length'  => 'Kode voucher maksimal 20 karakter',
            'is_unique'   => 'Kode voucher sudah digunakan'
        ],
        'jumlah_poin'  => [
            'required'      => 'Jumlah poin harus diisi',
            'numeric'       => 'Jumlah poin harus berupa angka',
            'greater_than'  => 'Jumlah poin harus lebih dari 0'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Custom Methods
    public function getActiveVouchers()
    {
        return $this->where('deleted_at', null)
                   ->findAll();
    }

    public function isVoucherValid($kodeVoucher)
    {
        return $this->where('kode_voucher', $kodeVoucher)
                   ->where('deleted_at', null)
                   ->first();
    }
}