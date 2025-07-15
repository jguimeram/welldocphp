<?php
namespace app\controllers;

use app\models\HomeModel;

class HomeController
{
    public function index()
    {
        $model = new HomeModel();
        $message = $model->getMessage();
        require __DIR__ . '/../views/home.php';
    }
}
