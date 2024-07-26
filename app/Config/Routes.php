<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/list/', 'ListController::index');
$routes->post('/list/new', 'ListController::new');
$routes->get('/list/edit/(:num)', 'ListController::edit/$1');
$routes->post('/list/edit/(:num)/manage-ip', 'ListController::manage_ip/$1');

service('auth')->routes($routes);
