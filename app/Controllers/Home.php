<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $session;
    protected $data = [];

    public function __construct()
    {
        $this->session = \Config\Services::session();

        // Inisialisasi data yang akan digunakan di semua view
        $this->data['title'] = 'Dashboard';
        $this->data['session'] = $this->session;
    }

    public function index()
    {
        // Tambahkan data yang ingin dikirim ke view
        $data = $this->data; // Mengambil data dari BaseController

        // Tampilkan view dengan data
        return view('layout/header', $data)
            . view('layout/topbar', $data)
            . view('layout/sidebar', $data)
            . view('admin/dashboard', $data)
            . view('layout/footer', $data);
    }

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }
}