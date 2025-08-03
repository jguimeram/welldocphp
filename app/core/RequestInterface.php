<?php
namespace app\core;

interface RequestInterface
{
    public function getMethod(): string;
    public function getUri(): string;
    public function getQueryParams(): array;
    public function getBody(): array;
    public function setParams(array $params): void;
    public function getParam(string $name): ?string;
    public function getParams(): array;
    public function getHeaders(): array;
    public function getHeader(string $name): ?string;
}
