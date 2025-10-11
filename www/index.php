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

$app->get('/categories/edit/{id}')
$app->run();