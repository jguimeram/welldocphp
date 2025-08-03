<?php

namespace app\controllers;

use app\core\RequestInterface;
use app\core\ResponseInterface;
use app\models\ItemsModel;
use app\services\ItemsService;
use app\services\ArrayCache;

class ItemsController
{
    private ItemsService $service;

    public function __construct(?ItemsService $service = null)
    {
        $this->service = $service ?? new ItemsService(new ItemsModel(), new ArrayCache(), false);
    }

    public function index(RequestInterface $request, ResponseInterface $response): void
    {
        $items = $this->service->all();
        $response->setBody(json_encode($items));
    }

    public function show(RequestInterface $request, ResponseInterface $response): void
    {
        $id = (int)$request->getParam('id');
        $item = $this->service->find($id);
        if ($item) {
            $response->setBody(json_encode($item));
        } else {
            $response->setStatusCode(404);
            $response->setBody(json_encode(['error' => 'Not found']));
        }
    }

    public function create(RequestInterface $request, ResponseInterface $response): void
    {
        $item = $this->service->create($request->getBody());
        $response->setStatusCode(201);
        $response->setBody(json_encode($item));
    }

    public function update(RequestInterface $request, ResponseInterface $response): void
    {
        $id = (int)$request->getParam('id');
        $item = $this->service->update($id, $request->getBody());
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
        if ($this->service->delete($id)) {
            $response->setStatusCode(204);
            $response->setBody('');
        } else {
            $response->setStatusCode(404);
            $response->setBody(json_encode(['error' => 'Not found']));
        }
    }
}
