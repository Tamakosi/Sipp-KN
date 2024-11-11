<?php

namespace App\Controllers;

use App\Models\MenuModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Menu extends BaseController
{
    protected $menuModel;
    protected $session;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Menu',
            'menu' => $this->menuModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('menu/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Menu Baru',
            'validation' => \Config\Services::validation()
        ];
        return view('menu/create', $data);
    }

    public function save()
    {
        if (!$this->validate($this->menuModel->validationRules, $this->menuModel->validationMessages)) {
            return redirect()->to('/menu/create')->withInput();
        }

        $this->menuModel->save([
            'id_menu' => $this->request->getVar('id_menu'),
            'nama_menu' => $this->request->getVar('nama_menu'),
            'harga_menu' => $this->request->getVar('harga_menu')
        ]);

        $this->session->setFlashdata('pesan', 'Menu berhasil ditambahkan.');
        return redirect()->to('/menu');
    }

    public function edit($id = null)
    {
        $menu = $this->menuModel->find($id);
        if (empty($menu)) {
            throw new PageNotFoundException('Menu ID ' . $id . ' tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Menu',
            'validation' => \Config\Services::validation(),
            'menu' => $menu
        ];
        return view('menu/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate($this->menuModel->validationRules, $this->menuModel->validationMessages)) {
            return redirect()->to('/menu/edit/' . $id)->withInput();
        }

        $this->menuModel->save([
            'id_menu' => $id,
            'nama_menu' => $this->request->getVar('nama_menu'),
            'harga_menu' => $this->request->getVar('harga_menu')
        ]);

        $this->session->setFlashdata('pesan', 'Menu berhasil diupdate.');
        return redirect()->to('/menu');
    }

    public function delete($id)
    {
        $menu = $this->menuModel->find($id);
        if (empty($menu)) {
            throw new PageNotFoundException('Menu ID ' . $id . ' tidak ditemukan.');
        }

        $this->menuModel->delete($id);
        $this->session->setFlashdata('pesan', 'Menu berhasil dihapus.');
        return redirect()->to('/menu');
    }
}