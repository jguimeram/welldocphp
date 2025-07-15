<?php
namespace app\controllers;

use app\core\RequestInterface;
use app\core\ResponseInterface;
use app\models\ItemsModel;

class ItemsController
{
    private ItemsModel $model;

    public function __construct()
    {
        $this->model = new ItemsModel();
    }

    public function index(RequestInterface $request, ResponseInterface $response): void
    {
        $items = $this->model->all();
        $response->setBody(json_encode($items));
    }

    public function show(RequestInterface $request, ResponseInterface $response): void
    {
        $id = (int)$request->getParam('id');
        $item = $this->model->find($id);
        if ($item) {
            $response->setBody(json_encode($item));
        } else {
            $response->setStatusCode(404);
            $response->setBody(json_encode(['error' => 'Not found']));
        }
    }

    public function create(RequestInterface $request, ResponseInterface $response): void
    {
        $item = $this->model->create($request->getBody());
        $response->setStatusCode(201);
        $response->setBody(json_encode($item));
    }

    public function update(RequestInterface $request, ResponseInterface $response): void
    {
        $id = (int)$request->getParam('id');
        $item = $this->model->update($id, $request->getBody());
        if ($item) {
            $response->setBody(json_encode($item));
        } else {
            $response->setStatusCode(404);
            $response->setBody(json_encode(['error' => 'Not found']));
        }
    }

    public function delete(RequestInterface $request, ResponseInterface $response): void
    {
        $id = (int)$request->getParam('id');
        if ($this->model->delete($id)) {
            $response->setStatusCode(204);
            $response->setBody('');
        } else {
            $response->setStatusCode(404);
            $response->setBody(json_encode(['error' => 'Not found']));
        }
    }
}
