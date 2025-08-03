<?php
namespace app\middleware;

use app\core\MiddlewareInterface;
use app\core\RequestInterface;
use app\core\ResponseInterface;

/**
 * Very basic authorization middleware.
 *
 * Expects the `Authorization` header to contain `Bearer secret` and
 * returns a 401 response if the header is missing or incorrect.
 */
class AuthMiddleware implements MiddlewareInterface
{
    public function handle(RequestInterface $request, ResponseInterface $response, callable $next): void
    {
        $auth = $request->getHeader('Authorization');
        if ($auth !== 'Bearer secret') {
            $response->setStatusCode(401);
            $response->setBody('Unauthorized');
            return;
        }
        $next($request, $response);
    }
}
