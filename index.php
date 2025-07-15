<?php
require __DIR__ . '/vendor/autoload.php';

use app\core\Request;
use app\core\Response;
use app\core\Router;

$request = new Request();
$response = new Response();
$router = new Router();

$router->dispatch($request, $response);
$response->send();
