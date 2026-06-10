<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Config\Services;
use App\Controllers\CategoryController;

/**
 * @internal
 */
class CategoryControllerUnitTest extends CIUnitTestCase
{
    private $controller;

    protected function setUp(): void
    {
        parent::setUp();
        
        // 1. Initialize the Controller
        $this->controller = new CategoryController();

        // 2. Mock and inject the Response object
        $response = Services::response();
        $this->controller->initController(Services::request(), $response, Services::logger());
    }

    public function testCreateMethodFailsValidationWhenNameIsTooShort()
    {
        // Setup a mock JSON request payload
        $jsonPayload = json_encode(['name' => 'A']); // 1 character is too short
        
        $request = Services::request();
        $request->setBody($jsonPayload);
        
        // Inject the updated request into the controller instance
        $this->controller->initController($request, Services::response(), Services::logger());

        // Invoke the method directly as a unit
        /** @var \CodeIgniter\HTTP\ResponseInterface $response */
        $response = $this->controller->create();

        // Assert directly on the returned Response object
        $this->assertSame(400, $response->getStatusCode());
        
        $body = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('messages', $body);
        $this->assertSame('Name required (min 2 chars)', $body['messages']['name']);
    }

    public function testDeleteMethodReturnsValidationErrorOnNonNumericId()
    {
        // Call the delete method directly with an invalid parameter type
        /** @var \CodeIgniter\HTTP\ResponseInterface $response */
        $response = $this->controller->delete('abc-invalid-id');

        $this->assertSame(400, $response->getStatusCode());
        
        $body = json_decode($response->getBody(), true);
        $this->assertSame('ungültige ID', $body['messages']['id']);
    }
}