<?php
namespace App\Controllers;

class MenuController extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new \App\Models\MenuModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Menu',
            'menu' => $this->menuModel->findAll()
        ];
        
        return view('layout/header')
             . view('layout/topbar')
             . view('layout/sidebar')
             . view('menu/index', $data)
             . view('layout/footer');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Menu'
        ];

        return view('layout/header')
             . view('layout/topbar')
             . view('layout/sidebar')
             . view('menu/create', $data)
             . view('layout/footer');
    }

    public function save()
    {
        if (!$this->validate([
            'id_menu' => 'required|is_unique[menu.id_menu]',
            'nama_menu' => 'required',
            'harga_menu' => 'required|numeric'
        ])) {
            session()->setFlashdata('error', 'Validasi gagal');
            return redirect()->back()->withInput();
        }

        try {
            $data = [
                'id_menu' => $this->request->getPost('id_menu'),
                'nama_menu' => $this->request->getPost('nama_menu'),
                'harga_menu' => $this->request->getPost('harga_menu')
            ];
            
            $this->menuModel->insert($data);
            
            session()->setFlashdata('success', 'Menu berhasil ditambahkan');
            return redirect()->to(base_url('menu'));
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menyimpan menu: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('menu'));
        }

        $menu = $this->menuModel->find($id);
        if (!$menu) {
            session()->setFlashdata('error', 'Menu tidak ditemukan');
            return redirect()->to(base_url('menu'));
        }

        $data = [
            'title' => 'Edit Menu',
            'menu' => $menu
        ];

        return view('layout/header')
             . view('layout/topbar')
             . view('layout/sidebar')
             . view('menu/edit', $data)
             . view('layout/footer');
    }

    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('menu'));
        }

        if (!$this->validate([
            'nama_menu' => 'required',
            'harga_menu' => 'required|numeric'
        ])) {
            session()->setFlashdata('error', 'Validasi gagal');
            return redirect()->back()->withInput();
        }

        try {
            $data = [
                'nama_menu' => $this->request->getPost('nama_menu'),
                'harga_menu' => $this->request->getPost('harga_menu')
            ];
            
            $this->menuModel->update($id, $data);
            
            session()->setFlashdata('success', 'Menu berhasil diupdate');
            return redirect()->to(base_url('menu'));
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal mengupdate menu: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('menu'));
        }
    
        try {
            $db = \Config\Database::connect();
            $db->transStart();
    
            // Hapus detail transaksi terkait
            $db->table('detailtransaksi')
               ->where('id_menu', $id)
               ->delete();
    
            // Hapus menu
            $this->menuModel->delete($id);
    
            $db->transComplete();
    
            if ($db->transStatus() === false) {
                throw new \Exception('Gagal menghapus menu dan transaksi terkait');
            }
    
            session()->setFlashdata('success', 'Menu dan transaksi terkait berhasil dihapus');
            return redirect()->to(base_url('menu'));
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal menghapus menu: ' . $e->getMessage());
            return redirect()->to(base_url('menu'));
        }
    }
}