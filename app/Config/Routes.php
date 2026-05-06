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