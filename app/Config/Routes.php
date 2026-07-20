<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
    $routes->get('/', 'AuthController::form');
    $routes->post('/login', 'AuthController::login');
    
    $routes->group('', ['filter' => 'auth'], function($routes) {
        $routes->get('home', 'PageController::home');
        $routes->get('logout', 'AuthController::logout');
        $routes->get('depot', 'OperationController::pageDepot');
        $routes->get('retrait', 'OperationController::pageRetrait');
        $routes->post('deposer', 'OperationController::depot');
        $routes->post('retrait', 'OperationController::retrait');
    });
    