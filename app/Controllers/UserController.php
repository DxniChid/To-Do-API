<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Shield\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');

        if (!$authHeader || !preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
            return $this->failUnauthorized('Missing or invalid Authorization header');
        }

        $token = $matches[1];

        try {
            $key = config('AuthJWT')->keys['default'][0]['secret'];
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $userId = $decoded->sub;

            $userModel = new UserModel();
            $user = $userModel->find($userId);

            if (!$user) {
                return $this->failUnauthorized('User not found');
            }

            return $this->respond([
                'id' => $user->id,
                'email' => $user->email,
                'username' => $user->username,
            ]);
        } catch (\Exception $e) {
            return $this->failUnauthorized('Invalid token');
        }
    }
}