<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthRoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = session('role') ?? 'cajero';

        if ($arguments === null || in_array($role, $arguments, true)) {
            return;
        }

        return redirect()->to('/')->with('error', 'No tienes privilegios para editar catálogos.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return;
    }
}
