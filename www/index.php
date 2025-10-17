<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;
use Src\Controllers\CategoriesController;
use Src\Controllers\GoodsController;

require __DIR__ . '/vendor/autoload.php';

$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

$container->set(PhpRenderer::class, function () {
    return new PhpRenderer(__DIR__ . '/templates');
});

ORM::configure('mysql:host=database;dbname=docker');
ORM::configure('username', 'docker');
ORM::configure('password', 'docker');

$app->get('/', [GoodsController::class, 'index']);
$app->get('/categories', [CategoriesController::class, 'index']);


//CRUD категорий
$app->get('/categories/create', [CategoriesController::class, 'create']);
$app->post('/categories/create', [CategoriesController::class, 'store']);

$app->get('/categories/edit/{id}', [CategoriesController::class, 'edit']);
$app->post('/categories/edit/{id}', [CategoriesController::class, 'update']);

$app->get('/categories/delete/{id}', [CategoriesController::class, 'delete']);

//CRUD товаров
$app->get('/goods', [GoodsController::class, 'adminIndex']);

$app->get('/goods/create', [GoodsController::class, 'create']);
$app->post('/goods/create', [GoodsController::class, 'store']);

$app->get('/goods/edit/{id}', [GoodsController::class, 'edit']);
$app->post('/goods/edit/{id}', [GoodsController::class, 'update']);

$app->get('/goods/delete/{id}', [GoodsController::class, 'delete']);



$app->get('/{category_id}',  [GoodsController::class, 'index']);

$app->run();