<?php
namespace app\core;

interface ResponseInterface
{
    public function setStatusCode(int $code): void;
    public function setBody(string $body): void;
    public function send(): void;
}
