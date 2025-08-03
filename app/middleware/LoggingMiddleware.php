<?php
namespace app\middleware;

use app\core\MiddlewareInterface;
use app\core\RequestInterface;
use app\core\ResponseInterface;

class LoggingMiddleware implements MiddlewareInterface
{
    public function handle(RequestInterface $request, ResponseInterface $response, callable $next): void
    {
        error_log($request->getMethod() . ' ' . $request->getUri());
        $next($request, $response);
    }
}
