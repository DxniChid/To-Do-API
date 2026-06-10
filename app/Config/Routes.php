
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->post('login', '\App\Controllers\LoginController::jwtLogin');

$routes->get('api/users', '\App\Controllers\UserController::index');

$routes->get('api/todos',          '\App\Controllers\TodoController::index');
$routes->post('api/todos',         '\App\Controllers\TodoController::create');
$routes->get('api/todos/(:num)',    '\App\Controllers\TodoController::show/$1');
$routes->put('api/todos/(:num)',    '\App\Controllers\TodoController::update/$1');
$routes->delete('api/todos/(:num)', '\App\Controllers\TodoController::delete/$1');


$routes->get('api/categories',          '\App\Controllers\CategoryController::index');
$routes->post('api/categories',         '\App\Controllers\CategoryController::create');
$routes->delete('api/categories/(:num)', '\App\Controllers\CategoryController::delete/$1');

$routes->get('api/api-keys', '\App\Controllers\ApiKeyController::index');
$routes->get('api/logs',     '\App\Controllers\LogController::index');

service('auth')->routes($routes);