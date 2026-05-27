<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    public function login()
    {
        helper('jwt');

        $data = $this->request->getJSON(true);

    if ($data['username'] !== 'admin' || $data['password'] !== '1234') {
        return $this->failUnauthorized('Ungültige Zugangsdaten');
    }

        $token = create_jwt([
            'user' => $data['username']
        ]);

        return $this->respond(['token'=>$token]);
    }
}