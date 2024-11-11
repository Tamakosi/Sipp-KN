<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['menu'] = $this->menuModel->findAll();
        
        // Render view secara terpisah
        $header = view('layout/header');
        $topbar = view('layout/topbar');
        $sidebar = view('layout/sidebar');
        $content = view('admin/overview', $data);
        $footer = view('layout/footer');
        
        // Gabungkan semua view
        return $header . $topbar . $sidebar . $content . $footer;
    }
}