<?php

namespace App\Controllers;

class MenuController extends BaseController
{
    protected $menuModel;
    protected $session;
    protected $data = [];

    public function __construct()
    {
        $this->menuModel = new \App\Models\MenuModel();
        $this->session = \Config\Services::session();

        // Inisialisasi data umum
        $this->data['session'] = $this->session;
    }

    public function index()
    {
        $this->data['title'] = 'Data Menu';
        $this->data['menu'] = $this->menuModel->findAll();

        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('menu/index', $this->data)
            . view('layout/footer', $this->data);
    }

    public function create()
    {
        $this->data['title'] = 'Tambah Menu';

        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('menu/create', $this->data)
            . view('layout/footer', $this->data);
    }

    public function save()
    {
        $validationRules = [
            'id_menu' => [
                'rules' => 'required|is_unique[menu.id_menu]|regex_match[/^M[0-9]{3}$/]',
                'errors' => [
                    'required' => 'ID Menu wajib diisi.',
                    'is_unique' => 'ID Menu sudah digunakan.',
                    'regex_match' => 'ID Menu harus diawali huruf "M" diikuti 3 digit angka (contoh: M001).'
                ],
            ],
            'nama_menu' => [
                'rules' => 'required|is_unique[menu.nama_menu]',
                'errors' => [
                    'required' => 'Nama Menu wajib diisi.',
                    'is_unique' => 'Nama Menu sudah digunakan.',
                ],
            ],
            'harga_menu' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Menu wajib diisi.',
                    'numeric' => 'Harga Menu harus berupa angka.',
                ],
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Lanjutkan proses penyimpanan data
        $hargaMenu = str_replace('.', '', $this->request->getPost('harga_menu'));
        $data = [
            'id_menu' => $this->request->getPost('id_menu'),
            'nama_menu' => $this->request->getPost('nama_menu'),
            'harga_menu' => $hargaMenu,
        ];

        try {
            $this->menuModel->insert($data);
            $this->session->setFlashdata('success', 'Menu berhasil ditambahkan');
            return redirect()->to(base_url('menu'));
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Gagal menyimpan menu: ' . $e->getMessage());
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
            $this->session->setFlashdata('error', 'Menu tidak ditemukan');
            return redirect()->to(base_url('menu'));
        }

        $this->data['title'] = 'Edit Menu';
        $this->data['menu'] = $menu;

        return view('layout/header', $this->data)
            . view('layout/topbar', $this->data)
            . view('layout/sidebar', $this->data)
            . view('menu/edit', $this->data)
            . view('layout/footer', $this->data);
    }

    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('menu'));
        }

        $originalMenu = $this->menuModel->find($id);
        if (!$originalMenu) {
            $this->session->setFlashdata('error', 'Menu tidak ditemukan');
            return redirect()->to(base_url('menu'));
        }

        // Validasi
        $validationRules = [
            'nama_menu' => [
                'rules' => 'required|is_unique[menu.nama_menu,id_menu,' . $id . ']',
                'errors' => [
                    'required' => 'Nama Menu wajib diisi.',
                    'is_unique' => 'Nama Menu sudah digunakan.',
                ],
            ],
            'harga_menu' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga Menu wajib diisi.',
                    'numeric' => 'Harga Menu harus berupa angka.',
                ],
            ],
        ];

        // Jika ID Menu diubah, tambahkan validasi untuk ID Menu
        if ($originalMenu['id_menu'] !== $this->request->getPost('id_menu')) {
            $validationRules['id_menu'] = [
                'rules' => 'required|is_unique[menu.id_menu]|regex_match[/^M[0-9]{3}$/]',
                'errors' => [
                    'required' => 'ID Menu wajib diisi.',
                    'is_unique' => 'ID Menu sudah digunakan.',
                    'regex_match' => 'ID Menu harus diawali huruf "M" diikuti 3 digit angka (contoh: M001).'
                ],
            ];
        }

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $data = [
                'id_menu' => $this->request->getPost('id_menu'),
                'nama_menu' => $this->request->getPost('nama_menu'),
                'harga_menu' => $this->request->getPost('harga_menu')
            ];

            $this->menuModel->update($id, $data);

            $this->session->setFlashdata('success', 'Menu berhasil diupdate');
            return redirect()->to(base_url('menu'));
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Gagal mengupdate menu: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url('menu'));
        }

        try {
            // Hapus menu
            if (!$this->menuModel->delete($id)) {
                throw new \Exception('Gagal menghapus menu');
            }

            $this->session->setFlashdata('success', 'Menu berhasil dihapus');
            return redirect()->to(base_url('menu'));
        } catch (\Exception $e) {
            $this->session->setFlashdata('error', 'Gagal menghapus menu: ' . $e->getMessage());
            return redirect()->to(base_url('menu'));
        }
    }

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }
}
