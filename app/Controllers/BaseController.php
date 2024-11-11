<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;

class BaseController extends Controller
{
    protected $helpers = ['url', 'form'];
    protected $menuModel;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->menuModel = new MenuModel();
    }
}