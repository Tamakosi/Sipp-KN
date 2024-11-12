<?php
namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $allowedFields = ['id_menu', 'nama_menu', 'harga_menu'];
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    // Tambahkan method untuk debug
    public function getLastQuery()
    {
        return $this->db->getLastQuery();
    }
}