<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('auth/jwt', '\App\Controllers\Auth\LoginController::jwtLogin');
service('auth')->routes($routes);
