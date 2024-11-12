<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('layout/header')
             . view('layout/topbar')
             . view('layout/sidebar')
             . view('admin/dashboard')
             . view('layout/footer');
    }
}