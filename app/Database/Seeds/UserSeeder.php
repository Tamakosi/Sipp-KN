<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new \App\Models\UserModel();

        $userData = [
            [
                'username' => 'owner',
                'email' => 'owner@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'id_karyawan' => 'K001', // Sesuaikan dengan ID Karyawan Owner
                'role' => 'owner',
            ],
            [
                'username' => 'operator',
                'email' => 'operator@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'id_karyawan' => 'K004', // Sesuaikan dengan ID Karyawan Operator
                'role' => 'operator',
            ],
            [
                'username' => 'manajer',
                'email' => 'manajer@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'id_karyawan' => 'K003', // Sesuaikan dengan ID Karyawan Manajer
                'role' => 'manajer',
            ],
        ];

        foreach ($userData as $user) {
            $userModel->insert($user);
        }
    }
}
