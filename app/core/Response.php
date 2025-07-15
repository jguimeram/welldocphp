<?php
namespace app\core;

class Response implements ResponseInterface
{
    private int $statusCode = 200;
    private string $body = '';

    public function setStatusCode(int $code): void
    {
        $this->statusCode = $code;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);
        echo $this->body;
    }
}
