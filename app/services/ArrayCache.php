<?php
namespace app\services;

class ArrayCache implements CacheInterface
{
    private array $cache = [];
    private array $expires = [];

    public function get(string $key)
    {
        if (isset($this->cache[$key])) {
            if ($this->expires[$key] === 0 || $this->expires[$key] > time()) {
                return $this->cache[$key];
            }
            unset($this->cache[$key], $this->expires[$key]);
        }
        return null;
    }

    public function set(string $key, $value, int $ttl = 0): void
    {
        $this->cache[$key] = $value;
        $this->expires[$key] = $ttl > 0 ? time() + $ttl : 0;
    }

    public function clear(string $key): void
    {
        unset($this->cache[$key], $this->expires[$key]);
    }
}
