<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/show/(:alpha)', 'ListController::show/$1');
$routes->view('/list', 'list');
$routes->post('/list/new', 'ListController::new');
$routes->get('/list/edit/(:num)', 'ListController::edit/$1');
$routes->post('/list/edit/(:num)/manage-ip', 'ListController::manage_ip/$1');

$routes->get('/user/whoami', 'UserController::whoami');

service('auth')->routes($routes);
