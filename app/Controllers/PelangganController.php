<?php

namespace App\Controllers;

class PelangganController extends BaseController
{
    protected $pelangganModel;
    protected $session;
    protected $data = [];

    public function __construct()
    {
        $this->pelangganModel = new \App\Models\PelangganModel();
        $this->session = \Config\Services::session();
        
        // Inisialisasi data umum
        $this->data['session'] = $this->session;
    }

    public function index()
    {
        $this->data['title'] = 'Data Pelanggan';
        $this->data['pelanggan'] = $this->pelangganModel->findAll();
        
        return view('layout/header', $this->data)
             . view('layout/topbar', $this->data)
             . view('layout/sidebar', $this->data)
             . view('pelanggan/index', $this->data)
             . view('layout/footer', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Tambah Pelanggan';

        return view('layout/header', $this->data)
             . view('layout/topbar', $this->data)
             . view('layout/sidebar', $this->data)
             . view('pelanggan/create', $this->data)
             . view('layout/footer', $this->data);
    }

    public function save()
    {
        if (!$this->validate([
            'id_pelanggan' => 'required|is_unique[pelanggan.id_pelanggan]',
            'nama_pelanggan' => 'required',
            'email_pelanggan' => 'required|valid_email'
        ])) {
            $this->session->setFlashdata('error', 'Validasi gagal');
            return redirect()->back()->withInput();
        }

        try {
            $data = [
                'id_pelanggan' => $this->request->getPost('id_pelanggan'),
                'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
                'email_pelanggan' => $this->request->getPost('email_pelanggan')
            ];
            
            $this->pelangganModel->insert($data);
            
            $this->session->setFlashdata('success', 'Pelanggan berhasil ditambahkan');
            return redirect()->to(base_url('pelanggan'));
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Gagal menyimpan pelanggan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('pelanggan'));
        }

        $pelanggan = $this->pelangganModel->find($id);
        if (!$pelanggan) {
            $this->session->setFlashdata('error', 'Pelanggan tidak ditemukan');
            return redirect()->to(base_url('pelanggan'));
        }

        $this->data['title'] = 'Edit Pelanggan';
        $this->data['pelanggan'] = $pelanggan;

        return view('layout/header', $this->data)
             . view('layout/topbar', $this->data)
             . view('layout/sidebar', $this->data)
             . view('pelanggan/edit', $this->data)
             . view('layout/footer', $this->data);
    }

    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('pelanggan'));
        }

        if (!$this->validate([
            'nama_pelanggan' => 'required',
            'email_pelanggan' => 'required|valid_email'
        ])) {
            $this->session->setFlashdata('error', 'Validasi gagal');
            return redirect()->back()->withInput();
        }

        try {
            $data = [
                'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
                'email_pelanggan' => $this->request->getPost('email_pelanggan')
            ];
            
            $this->pelangganModel->update($id, $data);
            
            $this->session->setFlashdata('success', 'Pelanggan berhasil diupdate');
            return redirect()->to(base_url('pelanggan'));
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Gagal mengupdate pelanggan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('pelanggan'));
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Cek apakah pelanggan masih memiliki transaksi
            $hasTransactions = $db->table('transaksi')
                                ->where('id_pelanggan', $id)
                                ->countAllResults() > 0;

            if ($hasTransactions) {
                throw new \Exception('Pelanggan tidak dapat dihapus karena masih memiliki transaksi');
            }

            // Hapus pelanggan
            $this->pelangganModel->delete($id);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menghapus pelanggan');
            }

            $this->session->setFlashdata('success', 'Pelanggan berhasil dihapus');
            return redirect()->to(base_url('pelanggan'));
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Gagal menghapus pelanggan: ' . $e->getMessage());
            return redirect()->to(base_url('pelanggan'));
        }
    }

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
}
}