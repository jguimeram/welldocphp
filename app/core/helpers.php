<?php
namespace app\core;

function user_call_func(callable $handler, RequestInterface $request, ResponseInterface $response): void
{
    call_user_func($handler, $request, $response);
}
