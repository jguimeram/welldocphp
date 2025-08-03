<?php
namespace app\core;

class Request implements RequestInterface
{
    private string $method;
    private string $uri;
    private array $query;
    private array $body;
    private array $headers;
    private array $params = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->uri = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        $this->query = $_GET;
        $this->body = $_POST;
        $this->headers = function_exists('getallheaders') ? getallheaders() : [];
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

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getHeader(string $name): ?string
    {
        return $this->headers[$name] ?? null;
    }

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function getParam(string $name): ?string
    {
        return $this->params[$name] ?? null;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
