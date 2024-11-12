<?php
namespace App\Controllers;

class KaryawanController extends BaseController
{
    protected $karyawanModel;

    public function __construct()
    {
        $this->karyawanModel = new \App\Models\KaryawanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Karyawan',
            'karyawan' => $this->karyawanModel->findAll()
        ];
        
        return view('layout/header')
             . view('layout/topbar')
             . view('layout/sidebar')
             . view('karyawan/index', $data)
             . view('layout/footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Karyawan'
        ];

        return view('layout/header')
             . view('layout/topbar')
             . view('layout/sidebar')
             . view('karyawan/create', $data)
             . view('layout/footer');
    }

    public function save()
    {
        if (!$this->validate([
            'id_karyawan' => 'required|is_unique[karyawan.id_karyawan]',
            'nama_karyawan' => 'required',
            'email_karyawan' => 'required|valid_email',
            'id_role' => 'required'
        ])) {
            session()->setFlashdata('error', 'Validasi gagal');
            return redirect()->back()->withInput();
        }

        try {
            $data = [
                'id_karyawan' => $this->request->getPost('id_karyawan'),
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'email_karyawan' => $this->request->getPost('email_karyawan'),
                'id_role' => $this->request->getPost('id_role')
            ];
            
            $this->karyawanModel->insert($data);
            
            session()->setFlashdata('success', 'Karyawan berhasil ditambahkan');
            return redirect()->to(base_url('karyawan'));
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menyimpan karyawan: ' . $e->getMessage());
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
            session()->setFlashdata('error', 'Karyawan tidak ditemukan');
            return redirect()->to(base_url('karyawan'));
        }

        $data = [
            'title' => 'Edit Karyawan',
            'karyawan' => $karyawan
        ];

        return view('layout/header')
             . view('layout/topbar')
             . view('layout/sidebar')
             . view('karyawan/edit', $data)
             . view('layout/footer');
    }

    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('karyawan'));
        }

        if (!$this->validate([
            'nama_karyawan' => 'required',
            'email_karyawan' => 'required|valid_email',
            'id_role' => 'required'
        ])) {
            session()->setFlashdata('error', 'Validasi gagal');
            return redirect()->back()->withInput();
        }

        try {
            $data = [
                'nama_karyawan' => $this->request->getPost('nama_karyawan'),
                'email_karyawan' => $this->request->getPost('email_karyawan'),
                'id_role' => $this->request->getPost('id_role')
            ];
            
            $this->karyawanModel->update($id, $data);
            
            session()->setFlashdata('success', 'Karyawan berhasil diupdate');
            return redirect()->to(base_url('karyawan'));
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal mengupdate karyawan: ' . $e->getMessage());
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
                session()->setFlashdata('error', 'Karyawan tidak ditemukan');
                return redirect()->to(base_url('karyawan'));
            }

            $this->karyawanModel->delete($id);
            
            session()->setFlashdata('success', 'Karyawan berhasil dihapus');
            return redirect()->to(base_url('karyawan'));
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menghapus karyawan: ' . $e->getMessage());
            return redirect()->to(base_url('karyawan'));
        }
    }
}