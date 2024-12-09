<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Services;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (!$session->get('logged_in')) {
            // User belum login
            // Redirect ke halaman unauthorized
            $session->setFlashdata('error', 'Anda tidak memiliki akses ke halaman tersebut');
            return redirect()->to(base_url('unauthorized'));
        }

        // Jika ada argument role, cek apakah user memiliki role tersebut
        if ($arguments) {
            $role = $session->get('role');
            // Ubah arguments menjadi array jika hanya satu
            if (!is_array($arguments)) {
                $arguments = [$arguments];
            }
            if (!in_array($role, $arguments)) {
                // Jika tidak memiliki akses, redirect ke halaman unauthorized
                $session->setFlashdata('error', 'Anda tidak memiliki akses ke halaman tersebut');
                return redirect()->to(base_url('unauthorized'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa setelah request
    }
}
