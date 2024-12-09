<?php

namespace App\Controllers;

class KaryawanController extends BaseController
{
    protected $karyawanModel;
    protected $session;
    protected $data = [];

    public function __construct()
    {
        $this->karyawanModel = new \App\Models\KaryawanModel();
        $this->session = \Config\Services::session();

        // Inisialisasi data umum
        $this->data['session'] = $this->session;
    }

    public function index()
    {
        $this->data['title'] = 'Data Karyawan';
        $this->data['karyawan'] = $this->karyawanModel->findAll();

        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('karyawan/index', $this->data)
            . view('layout/footer', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Tambah Karyawan';

        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('karyawan/create', $this->data)
            . view('layout/footer', $this->data);
    }

    public function save()
    {
        if (
            !$this->validate([
                'id_karyawan' => [
                    'rules' => 'required|is_unique[karyawan.id_karyawan]|regex_match[/^K[0-9]{3}$/]',
                    'errors' => [
                        'required' => 'ID Karyawan wajib diisi.',
                        'is_unique' => 'ID Karyawan sudah terdaftar.',
                        'regex_match' => 'Format ID Karyawan tidak valid. Contoh: K001'
                    ]
                ],
                'nama_karyawan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Karyawan wajib diisi.'
                    ]
                ],
                'email_karyawan' => [
                    'rules' => 'required|valid_email|is_unique[karyawan.email_karyawan]',
                    'errors' => [
                        'required' => 'Email wajib diisi.',
                        'valid_email' => 'Email tidak valid.',
                        'is_unique' => 'Email sudah terdaftar.'
                    ]
                ],
                'id_role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role wajib dipilih.'
                    ]
                ]
            ])
        ) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        try {
            $data = [
                'id_karyawan' => $this->request->getPost('id_karyawan'),
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'email_karyawan' => $this->request->getPost('email_karyawan'),
                'id_role' => $this->request->getPost('id_role')
            ];

            $this->karyawanModel->insert($data);

            $this->session->setFlashdata('success', 'Karyawan berhasil ditambahkan');
            return redirect()->to(base_url('karyawan'));
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Gagal menyimpan karyawan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('karyawan'));
        }

        $karyawan = $this->karyawanModel->find($id);
        if (!$karyawan) {
            $this->session->setFlashdata('error', 'Karyawan tidak ditemukan');
            return redirect()->to(base_url('karyawan'));
        }

        $this->data['title'] = 'Edit Karyawan';
        $this->data['karyawan'] = $karyawan;

        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('karyawan/edit', $this->data)
            . view('layout/footer', $this->data);
    }

    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('karyawan'));
        }

        // Ambil data karyawan lama
        $karyawanLama = $this->karyawanModel->find($id);

        // Cek jika data tidak ditemukan
        if (!$karyawanLama) {
            $this->session->setFlashdata('error', 'Karyawan tidak ditemukan');
            return redirect()->to(base_url('karyawan'));
        }

        // Validasi
        if (
            !$this->validate([
                'nama_karyawan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Karyawan wajib diisi.'
                    ]
                ],
                'email_karyawan' => [
                    'rules' => 'required|valid_email|is_unique[karyawan.email_karyawan,id_karyawan,' . $id . ']',
                    'errors' => [
                        'required' => 'Email wajib diisi.',
                        'valid_email' => 'Email tidak valid.',
                        'is_unique' => 'Email sudah terdaftar.'
                    ]
                ],
                'id_role' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role wajib dipilih.'
                    ]
                ]
            ])
        ) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        try {
            $data = [
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'email_karyawan' => $this->request->getPost('email_karyawan'),
                'id_role' => $this->request->getPost('id_role')
            ];

            $this->karyawanModel->update($id, $data);

            $this->session->setFlashdata('success', 'Karyawan berhasil diupdate');
            return redirect()->to(base_url('karyawan'));
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Gagal mengupdate karyawan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('karyawan'));
        }

        try {
            $karyawan = $this->karyawanModel->find($id);
            if (!$karyawan) {
                $this->session->setFlashdata('error', 'Karyawan tidak ditemukan');
                return redirect()->to(base_url('karyawan'));
            }

            $this->karyawanModel->delete($id);

            $this->session->setFlashdata('success', 'Karyawan berhasil dihapus');
            return redirect()->to(base_url('karyawan'));
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Gagal menghapus karyawan: ' . $e->getMessage());
            return redirect()->to(base_url('karyawan'));
        }
    }

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }
}
