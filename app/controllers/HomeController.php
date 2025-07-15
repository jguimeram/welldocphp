<?php
namespace app\controllers;

use app\models\HomeModel;
use app\core\RequestInterface;
use app\core\ResponseInterface;
use app\core\View;

class HomeController
{
    public function index(RequestInterface $request, ResponseInterface $response): void
    {
        $model = new HomeModel();
        $message = $model->getMessage();
        $view = new View();
        $response->setBody($view->render('home', ['message' => $message]));
    }
}
