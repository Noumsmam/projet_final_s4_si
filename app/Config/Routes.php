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
        $routes->get('historique', 'OperationController::historique');
        $routes->get('transfert', 'OperationController::pageTransfert');
        $routes->post('transfert', 'OperationController::transfert');
        $routes->get('gestion-clients', 'PageController::getSituationAllCompte');
        $routes->get('gestion-clients/creer', 'ClientController::create');
        $routes->post('gestion-clients/creer', 'ClientController::store');
        $routes->get('gestion-clients/modifier/(:num)', 'ClientController::edit/$1');
        $routes->post('gestion-clients/modifier/(:num)', 'ClientController::update/$1');
        $routes->post('gestion-clients/supprimer/(:num)', 'ClientController::delete/$1');
    });
    