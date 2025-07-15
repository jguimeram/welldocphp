<?php
namespace app\core;

interface RequestInterface
{
    public function getMethod(): string;
    public function getUri(): string;
    public function getQueryParams(): array;
    public function getBody(): array;
}
