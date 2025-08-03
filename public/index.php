<?php
require __DIR__ . '/../vendor/autoload.php';

use app\core\Router;
use app\controllers\HomeController;
use app\controllers\ItemsController;
use app\middleware\AuthMiddleware;
use app\middleware\CorsMiddleware;
use app\middleware\LoggingMiddleware;

$router = new Router();
$router->addMiddleware(new LoggingMiddleware());
$router->addMiddleware(new CorsMiddleware());
$router->addMiddleware(new AuthMiddleware());

$home = new HomeController();
$items = new ItemsController();

$router->get('/', [$home, 'index']);
$router->get('/items', [$items, 'index']);
$router->get('/items/{id}', [$items, 'show']);
$router->post('/items', [$items, 'create']);
$router->put('/items/{id}', [$items, 'update']);
$router->delete('/items/{id}', [$items, 'delete']);

$response = $router->dispatch();
$response->send();
