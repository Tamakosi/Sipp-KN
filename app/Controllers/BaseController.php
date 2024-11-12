<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;
use App\Models\PelangganModel;
use App\Models\KaryawanModel;

class BaseController extends Controller
{
    protected $helpers = ['url', 'form'];
    protected $menuModel;
    protected $pelangganModel;
    protected $karyawanModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->menuModel = new MenuModel();
        $this->pelangganModel = new PelangganModel();
        $this->karyawanModel = new karyawanModel();
    }
}