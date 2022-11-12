<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class MitraFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Kondisi sebelum login
        if (session()->get('privUser') == "") {
            return redirect()->to('/home/index');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kondisi ketika login
        // Kondisi sebelum login
        if (session()->get('privUser') == 5) {
            return redirect()->to('/mitra/dashboard');
        }
    }
}
