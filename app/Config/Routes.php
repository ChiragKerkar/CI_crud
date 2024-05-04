<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/registration', 'Home::registration');

$routes->get('/login', 'Home::login');

$routes->get('/dashboard', 'Home::dashboard');

$routes->get('/dealer_data/(:num)', 'Home::additional_data/$1');

$routes->get('/getDealerData/(:num)', 'Home::getDealerData/$1');

$routes->post('/register_user', 'Home::register_user');

$routes->post('/login_user', 'Home::login_user');

$routes->post('/add_dealer_data', 'Home::add_dealer_data');
