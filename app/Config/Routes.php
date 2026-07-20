<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
    // $routes->get('/login', 'AuthController::form');
    // $routes->post('/login', 'AuthController::login');
    // $routes->get('/', 'LivresController::liste');
    // $routes->get('/livres/(:num)', 'LivresController::details/$1'); 
    // $routes->get('/recherche', 'LivresController::recherche');
    // $routes->post('/rechercher', 'LivresController::rechercher');
    $routes->get('/depot','');
    $routes->group('', ['filter' => 'auth'], function($routes) {
        $routes->get('ajouter', 'LivresController::ajouter');
        $routes->post('creer', 'LivresController::creer');
        $routes->get('emprunts', 'EmpruntsController::disponibles');
        $routes->get('emprunter/(:num)', 'EmpruntsController::emprunter/$1');
        $routes->get('rendre', 'EmpruntsController::pagerendre');
        $routes->get('rendre/(:num)', 'EmpruntsController::rendre/$1');
        $routes->get('deconnexion', 'AuthController::logout');
    });
    
    $routes->group('admin', ['filter' => 'role:admin'], function($routes) {
        $routes->get('supprimer/(:num)', 'LivresController::supprimer/$1');
    });