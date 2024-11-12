<?php
namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $allowedFields = ['id_pelanggan', 'nama_pelanggan', 'email_pelanggan'];
    protected $useTimestamps = true;
    
    // Tentukan nama kolom timestamps jika berbeda dengan default
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    // Format timestamp (opsional)
    protected $dateFormat    = 'datetime';
}