<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'email', 'password', 'id_karyawan', 'role'];
    protected $useTimestamps = true;

    // Tambahkan method untuk mendapatkan user berdasarkan username
    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}
