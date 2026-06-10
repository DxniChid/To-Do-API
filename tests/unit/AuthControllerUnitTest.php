<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Config\Services;
use App\Controllers\AuthController;

/**
 * @internal
 */
class AuthControllerUnitTest extends CIUnitTestCase
{
    private $controller;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->controller = new AuthController();
        $this->controller->initController(Services::request(), Services::response(), Services::logger());
    }

    public function testLoginFailsAndReturnsUnauthorizedOnWrongCredentials()
    {
        $jsonPayload = json_encode([
            'username' => 'wrong-user',
            'password' => 'wrong-pass'
        ]);

        $request = Services::request();
        $request->setBody($jsonPayload);
        
        $this->controller->initController($request, Services::response(), Services::logger());

        /** @var \CodeIgniter\HTTP\ResponseInterface $response */
        $response = $this->controller->login();

        // Assert response properties directly
        $this->assertSame(401, $response->getStatusCode());
        
        $body = json_decode($response->getBody(), true);
        $this->assertSame('Invalid credentials', $body['messages']['error']);
    }
}