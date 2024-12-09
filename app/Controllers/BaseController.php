<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;
use App\Models\PelangganModel;
use App\Models\KaryawanModel;
use App\Models\TransaksiModel;
use App\Models\VoucherModel;

class BaseController extends Controller
{
    protected $session;
    protected $data = [];
    protected $helpers = ['url', 'form'];
    protected $menuModel;
    protected $pelangganModel;
    protected $karyawanModel;
    protected $transaksiModel;
    protected $voucherModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Inisialisasi model dengan try-catch untuk menangani error
        try {
            $this->menuModel = new MenuModel();
            $this->pelangganModel = new PelangganModel();
            $this->karyawanModel = new KaryawanModel();
            $this->transaksiModel = model('App\Models\TransaksiModel');
            $this->voucherModel = new VoucherModel();
        } catch (\Exception $e) {
            log_message('error', 'Error initializing models: ' . $e->getMessage());
        }

        // Inisialisasi session
        $this->session = \Config\Services::session();
        $this->data['session'] = $this->session;
        $this->data['username'] = $this->session->get('username') ?? 'Guest';
        $this->data['role'] = $this->session->get('role') ?? 'Guest';
    }

    public function getModel($modelName)
    {
        $modelProperty = strtolower($modelName) . 'Model';
        return $this->$modelProperty;
    }
}