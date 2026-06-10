<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Config\Services;
use App\Controllers\TodoController;

/**
 * @internal
 */
class TodoControllerUnitTest extends CIUnitTestCase
{
    private $controller;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->controller = new TodoController();
        $this->controller->initController(Services::request(), Services::response(), Services::logger());
    }

    public function testCreateMethodFailsValidationOnMissingFields()
    {
        // An empty array should trigger your $this->validate() logic block
        $jsonPayload = json_encode([]); 
        
        $request = Services::request();
        $request->setBody($jsonPayload);
        
        $this->controller->initController($request, Services::response(), Services::logger());

        /** @var \CodeIgniter\HTTP\ResponseInterface $response */
        $response = $this->controller->create();

        // Verify validation catches empty structures before database interaction
        $this->assertSame(400, $response->getStatusCode());
        
        $body = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('title', $body['messages']);
        $this->assertArrayHasKey('category_id', $body['messages']);
    }

    public function testUpdateMethodReturnsValidationErrorOnStringId()
    {
        /** @var \CodeIgniter\HTTP\ResponseInterface $response */
        $response = $this->controller->update('string-id');

        $this->assertSame(400, $response->getStatusCode());
        
        $body = json_decode($response->getBody(), true);
        $this->assertSame('Invalid ID', $body['messages']['id']);
    }
}