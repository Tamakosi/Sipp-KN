<?php
namespace App\Controllers;

class PelangganController extends BaseController
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new \App\Models\PelangganModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pelanggan',
            'pelanggan' => $this->pelangganModel->findAll()
        ];
        
        return view('layout/header')
             . view('layout/topbar')
             . view('layout/sidebar')
             . view('pelanggan/index', $data)
             . view('layout/footer');
    }

    // PelangganController.php
public function create()
{
    $data = [
        'title' => 'Tambah Pelanggan'
    ];

    return view('layout/header')
         . view('layout/topbar')
         . view('layout/sidebar')
         . view('pelanggan/create', $data)
         . view('layout/footer');
}

public function save()
{
    if (!$this->validate([
        'id_pelanggan' => 'required|is_unique[pelanggan.id_pelanggan]',
        'nama_pelanggan' => 'required',
        'email_pelanggan' => 'required|valid_email'
    ])) {
        session()->setFlashdata('error', 'Validasi gagal');
        return redirect()->back()->withInput();
    }

    try {
        $data = [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'email_pelanggan' => $this->request->getPost('email_pelanggan')
        ];
        
        $this->pelangganModel->insert($data);
        
        session()->setFlashdata('success', 'Pelanggan berhasil ditambahkan');
        return redirect()->to(base_url('pelanggan'));
    } catch (\Exception $e) {
        session()->setFlashdata('error', 'Gagal menyimpan pelanggan: ' . $e->getMessage());
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
        session()->setFlashdata('error', 'Pelanggan tidak ditemukan');
        return redirect()->to(base_url('pelanggan'));
    }

    $data = [
        'title' => 'Edit Pelanggan',
        'pelanggan' => $pelanggan
    ];

    return view('layout/header')
         . view('layout/topbar')
         . view('layout/sidebar')
         . view('pelanggan/edit', $data)
         . view('layout/footer');
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
        session()->setFlashdata('error', 'Validasi gagal');
        return redirect()->back()->withInput();
    }

    try {
        $data = [
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'email_pelanggan' => $this->request->getPost('email_pelanggan')
        ];
        
        $this->pelangganModel->update($id, $data);
        
        session()->setFlashdata('success', 'Pelanggan berhasil diupdate');
        return redirect()->to(base_url('pelanggan'));
    } catch (\Exception $e) {
        session()->setFlashdata('error', 'Gagal mengupdate pelanggan: ' . $e->getMessage());
        return redirect()->back()->withInput();
    }
}

public function delete($id = null)
{
    if ($id == null) {
        return redirect()->to(base_url('pelanggan'));
    }

    try {
        $pelanggan = $this->pelangganModel->find($id);
        if (!$pelanggan) {
            session()->setFlashdata('error', 'Pelanggan tidak ditemukan');
            return redirect()->to(base_url('pelanggan'));
        }

        $this->pelangganModel->delete($id);
        
        session()->setFlashdata('success', 'Pelanggan berhasil dihapus');
        return redirect()->to(base_url('pelanggan'));
    } catch (\Exception $e) {
        session()->setFlashdata('error', 'Gagal menghapus pelanggan: ' . $e->getMessage());
        return redirect()->to(base_url('pelanggan'));
    }
}
}