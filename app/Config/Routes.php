<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Routes pour les Notes
$routes->get('notes', 'NotesController::index');
$routes->get('notes/formulaire/(:num)', 'NotesController::formulaire/$1');
$routes->post('notes/add', 'NotesController::add');
$routes->get('notes/delete/(:num)', 'NotesController::delete/$1');