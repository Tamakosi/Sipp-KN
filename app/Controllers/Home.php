<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
    //    echo view('layout/header');
    //    echo view('layout/topbar');
    //    echo view('layout/sidebar');
       echo view('admin/overview');
    //    echo view('layout/footer');
    }

    public function about($nama = null, $umur = 0)
    {
        echo "Hi, nama saya adalah $nama. Usia saya $umur tahun.";
    }
}
