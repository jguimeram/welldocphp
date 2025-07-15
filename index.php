<?php
require __DIR__ . '/vendor/autoload.php';

use app\core\Request;
use app\core\Response;
use app\core\Router;
use app\controllers\HomeController;
use app\controllers\ItemsController;

$request = new Request();
$response = new Response();
$router = new Router();

$home = new HomeController();
$items = new ItemsController();

$router->get('/', [$home, 'index']);
$router->get('/items', [$items, 'index']);
$router->get('/items/{id}', [$items, 'show']);
$router->post('/items', [$items, 'create']);
$router->put('/items/{id}', [$items, 'update']);
$router->delete('/items/{id}', [$items, 'delete']);

$router->dispatch($request, $response);
$response->send();
