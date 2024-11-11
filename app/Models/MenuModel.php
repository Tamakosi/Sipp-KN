<?php
namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table            = 'menu';
    protected $primaryKey       = 'id_menu';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['id_menu', 'nama_menu', 'harga_menu'];
}