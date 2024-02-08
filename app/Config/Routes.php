<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MarvelCrud::index');
$routes->get('/create', 'MarvelCrud::viewCreate');
$routes->get('/getCharacter/(:any)', 'MarvelCrud::getCharacter/$1');
$routes->get('/delete/(:any)', 'MarvelCrud::delete/$1');
$routes->post('/create', 'MarvelCrud::create');
$routes->post('/update', 'MarvelCrud::update');

