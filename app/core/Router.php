<?php
namespace app\core;

class Router
{
    public function dispatch(RequestInterface $request, ResponseInterface $response): void
    {
        $controllerName = ucfirst($request->getQueryParams()['controller'] ?? 'home');
        $action = $request->getQueryParams()['action'] ?? 'index';
        $controllerClass = 'app\\controllers\\' . $controllerName . 'Controller';

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $action)) {
                $controller->$action();
                return;
            }
            $response->setStatusCode(404);
            $response->setBody('Action not found');
            return;
        }
        $response->setStatusCode(404);
        $response->setBody('Controller not found');
    }
}
