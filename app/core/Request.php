<?php
namespace app\core;

class Request implements RequestInterface
{
    private string $method;
    private string $uri;
    private array $query;
    private array $body;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        $this->query = $_GET;
        $this->body = $_POST;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getQueryParams(): array
    {
        return $this->query;
    }

    public function getBody(): array
    {
        return $this->body;
    }
}
