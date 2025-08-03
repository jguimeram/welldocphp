<?php
namespace app\core;

/**
 * Middleware components can inspect or modify the request/response
 * and decide whether to continue to the next middleware in the chain.
 */
interface MiddlewareInterface
{
    /**
     * Process an incoming request.
     *
     * Implementations may modify the request or response and must
     * invoke the `$next` callable to pass control to the next middleware.
     */
    public function handle(RequestInterface $request, ResponseInterface $response, callable $next): void;
}
