<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    public function login()
    {
        helper('jwt');

        $token = create_jwt(['user'=>'admin']);

        return $this->respond(['token'=>$token]);
    }
}