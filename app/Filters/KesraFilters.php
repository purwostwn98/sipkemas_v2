<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class KesraFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Kondisi sebelum login
        if (session()->get('login') != true) {
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Kondisi ketika login
        // Kondisi sebelum login
        if (session()->get('privUser') == 4) {
            return redirect()->to('/kesra/dashboard');
        }
    }
}
