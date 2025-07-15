<?php
namespace app\services;

interface CacheInterface
{
    public function get(string $key);
    public function set(string $key, $value, int $ttl = 0): void;
    public function clear(string $key): void;
}
