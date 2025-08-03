<?php
namespace app\middleware;

use app\core\MiddlewareInterface;
use app\core\RequestInterface;
use app\core\ResponseInterface;

/**
 * Adds CORS headers and short-circuits preflight `OPTIONS` requests.
 */
class CorsMiddleware implements MiddlewareInterface
{
    public function handle(RequestInterface $request, ResponseInterface $response, callable $next): void
    {
        $response->addHeader('Access-Control-Allow-Origin', '*');
        $response->addHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->addHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        if ($request->getMethod() === 'OPTIONS') {
            $response->setStatusCode(204);
            return;
        }

        $next($request, $response);
    }
}
