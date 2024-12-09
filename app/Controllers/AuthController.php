<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        $data['title'] = 'Login';

        return view('auth/login', $this->data);
    }

    public function processLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi input
        if (empty($username) || empty($password)) {
            $this->session->setFlashdata('error', 'Username dan Password wajib diisi');
            return redirect()->back()->withInput();
        }

        $user = $this->userModel->getUserByUsername($username);

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Pastikan $user['username'] dan $user['role'] tidak null
                if (isset($user['username'], $user['role'])) {
                    // Set session
                    $this->session->set([
                        'logged_in' => true,
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'role' => $user['role'],
                        'id_karyawan' => $user['id_karyawan'],
                    ]);

                    return redirect()->to(base_url('/'));
                } else {
                    $this->session->setFlashdata('error', 'Data pengguna tidak lengkap. Silakan hubungi administrator.');
                    return redirect()->back()->withInput();
                }
            } else {
                $this->session->setFlashdata('error', 'Password salah');
                return redirect()->back()->withInput();
            }
        } else {
            $this->session->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }
}
