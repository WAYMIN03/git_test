<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('PostController', 'PostController::index');
$routes->get('PostController/create', 'PostController::create'); // 顯示新增表單頁面
$routes->post('PostController/store', 'PostController::store');   // 接收表單 POST 資料
$routes->get('PostController/show/(:num)', 'PostController::show/$1');