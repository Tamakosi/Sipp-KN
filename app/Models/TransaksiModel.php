<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields = ['id_karyawan', 'id_pelanggan', 'kode_voucher'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getTransaksiWithRelations()
    {
        return $this->select('transaksi.*, karyawan.nama_karyawan, pelanggan.nama_pelanggan')
                    ->join('karyawan', 'karyawan.id_karyawan = transaksi.id_karyawan')
                    ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
                    ->findAll();
    }
}