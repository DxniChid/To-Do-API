<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ApiKeyModel;
use App\Models\LogModel;

class ApiKeyFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $key = $request->getHeaderLine('X-API-KEY');

        $model = new ApiKeyModel();

        if (!$model->where('key', $key)->first()) {
            return service('response')->setStatusCode(401)->setJSON(['error'=>'Invalid API Key']);
        }

        service('request')->apiKey = $key;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $log = new LogModel();

        $log->insert([
            'method' => $request->getMethod(),
            'endpoint' => current_url(),
            'status' => $response->getStatusCode(),
            'api_key' => $request->apiKey ?? null
        ]);
    }
}