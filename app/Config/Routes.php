<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
    return redirect()->to('/login');
});

$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

$routes->get('/liste-eleves', function () {
    if (!session()->get('user')) {
        return redirect()->to('/login');
    }
    return view('liste-eleves');
});


$routes->get('/list', 'Home::list');

$routes->get('notes', 'NotesController::index');
$routes->get('notes/formulaire/(:num)', 'NotesController::formulaire/$1');
$routes->post('notes/add', 'NotesController::add');
$routes->get('notes/delete/(:num)', 'NotesController::delete/$1');