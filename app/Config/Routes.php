<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->post('login', 'AuthController::login');

$routes->group('api', ['filter' => 'apikey'], function($routes) {

    $routes->resource('todos');
    $routes->resource('categories');

});
// app/Config/Routes.php
<<<<<<< Updated upstream
$routes->post('auth/jwt', '\App\Controllers\Auth\LoginController::jwtLogin');
$routes->get('api/users', '\App\Controllers\Auth\UserController::index');
=======
$routes->post('auth/jwt', '\App\Controllers\LoginController::jwtLogin');
$routes->get('api/users', '\App\Controllers\UserController::index');
service('auth')->routes($routes);
>>>>>>> Stashed changes
