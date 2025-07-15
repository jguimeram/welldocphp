<?php
namespace app\core;

class ResponseFactory
{
    private Response $prototype;

    public function __construct()
    {
        $this->prototype = new Response();
    }

    public function create(): ResponseInterface
    {
        return clone $this->prototype;
    }
}
