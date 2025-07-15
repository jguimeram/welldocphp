<?php
namespace app\core;

class RequestFactory
{
    private Request $prototype;

    public function __construct()
    {
        $this->prototype = new Request();
    }

    public function create(): RequestInterface
    {
        return clone $this->prototype;
    }
}
