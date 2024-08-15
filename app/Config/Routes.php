<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\ListController;
use App\Controllers\HomeController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/show/(:segment)', [ListController::class, 'show']);
$routes->get('/list', [ListController::class, 'index']);
$routes->view('/list/(:num)', 'list');
$routes->get('/data/list/(:segment)', [ListController::class, 'get']);
$routes->post('/list/new', 'ListController::new');
$routes->post('/list/new', 'ListController::new');
$routes->get('/list/edit/(:num)', 'ListController::edit/$1');
$routes->post('/list/edit/(:num)/manage-ip', 'ListController::manage_ip/$1');

$routes->get('/user/whoami', 'UserController::whoami');

service('auth')->routes($routes);
