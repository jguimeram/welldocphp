<?php
namespace app\core;

interface MiddlewareInterface
{
    public function handle(RequestInterface $request, ResponseInterface $response, callable $next): void;
}
