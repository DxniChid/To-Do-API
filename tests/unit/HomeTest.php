<?php

namespace Tests\Unit;

use App\Controllers\Home;
use CodeIgniter\Config\Services;
use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
class HomeTest extends CIUnitTestCase
{
    public function testIndexReturnsWelcomePage(): void
    {
        $controller = new Home();
        $controller->initController(Services::request(), Services::response(), Services::logger());

        $response = $controller->index();

        $this->assertIsString($response);
        $this->assertStringContainsString('Welcome to CodeIgniter 4!', $response);
    }
}
