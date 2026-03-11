<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'CatalogController::index');
$routes->group('catalogo', ['filter' => 'authRole:admin,encargado'], static function ($routes) {
    $routes->get('productos', 'CatalogController::products');
    $routes->get('menus', 'CatalogController::menus');
    $routes->get('combos', 'CatalogController::combos');

    $routes->post('productos', 'CatalogController::storeProduct');
    $routes->post('menus', 'CatalogController::storeMenu');
    $routes->post('combos', 'CatalogController::storeCombo');
});
