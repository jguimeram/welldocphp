<?php
namespace app\middleware;

use app\core\MiddlewareInterface;
use app\core\RequestInterface;
use app\core\ResponseInterface;

/**
 * Logs each incoming request using PHP's `error_log`.
 */
class LoggingMiddleware implements MiddlewareInterface
{
    public function handle(RequestInterface $request, ResponseInterface $response, callable $next): void
    {
        error_log($request->getMethod() . ' ' . $request->getUri());
        $next($request, $response);
    }
}
