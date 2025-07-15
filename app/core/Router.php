<?php
namespace app\core;


class Router
{
    private array $routes = [];
    private RequestFactory $requestFactory;
    private ResponseFactory $responseFactory;

    public function __construct(?RequestFactory $requestFactory = null, ?ResponseFactory $responseFactory = null)
    {
        $this->requestFactory = $requestFactory ?? new RequestFactory();
        $this->responseFactory = $responseFactory ?? new ResponseFactory();
    }

    public function get(string $pattern, callable $handler): void
    {
        $this->addRoute('GET', $pattern, $handler);
    }

    public function post(string $pattern, callable $handler): void
    {
        $this->addRoute('POST', $pattern, $handler);
    }

    public function put(string $pattern, callable $handler): void
    {
        $this->addRoute('PUT', $pattern, $handler);
    }

    public function delete(string $pattern, callable $handler): void
    {
        $this->addRoute('DELETE', $pattern, $handler);
    }

    private function addRoute(string $method, string $pattern, callable $handler): void
    {
        $this->routes[$method][] = ['pattern' => $pattern, 'handler' => $handler];
    }

    public function dispatch(): ResponseInterface
    {
        $request = $this->requestFactory->create();
        $response = $this->responseFactory->create();

        $method = $request->getMethod();
        $uri = rtrim($request->getUri(), '/');
        if ($uri === '') {
            $uri = '/';
        }

        foreach ($this->routes[$method] ?? [] as $route) {
            $pattern = '#^' . preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route['pattern']) . '$#';
            if (preg_match($pattern, $uri, $matches)) {
                $params = [];
                foreach ($matches as $key => $value) {
                    if (!is_int($key)) {
                        $params[$key] = $value;
                    }
                }
                $request->setParams($params);
                call_user_func($route['handler'], $request, $response);
                return $response;
            }
        }

        $response->setStatusCode(404);
        $response->setBody('Not Found');
        return $response;
    }
}
