<?php

namespace app\services;

use app\models\ItemsModel;
use app\services\CacheInterface;

class ItemsService
{
    private ItemsModel $model;
    private ?CacheInterface $cache;
    private bool $useCache;

    public function __construct(?ItemsModel $model = null, ?CacheInterface $cache = null, bool $useCache = false)
    {
        $this->model = $model ?? new ItemsModel();
        $this->cache = $cache;
        $this->useCache = $useCache;
    }

    public function enableCache(bool $enabled): void
    {
        $this->useCache = $enabled;
    }

    public function all(): array
    {
        $key = 'items.all';
        if ($this->useCache && $this->cache) {
            $cached = $this->cache->get($key);
            if ($cached !== null) {
                return $cached;
            }
        }
        $data = $this->model->all();
        if ($this->useCache && $this->cache) {
            $this->cache->set($key, $data);
        }
        return $data;
    }

    public function find(int $id): ?array
    {
        $key = "items.$id";
        if ($this->useCache && $this->cache) {
            $cached = $this->cache->get($key);
            if ($cached !== null) {
                return $cached;
            }
        }
        $data = $this->model->find($id);
        if ($data !== null && $this->useCache && $this->cache) {
            $this->cache->set($key, $data);
        }
        return $data;
    }

    public function create(array $data): array
    {
        $item = $this->model->create($data);
        if ($this->useCache && $this->cache) {
            $this->cache->clear('items.all');
            $this->cache->set('items.' . $item['id'], $item);
        }
        return $item;
    }

    public function update(int $id, array $data): ?array
    {
        $item = $this->model->update($id, $data);
        if ($this->useCache && $this->cache) {
            $this->cache->clear('items.all');
            if ($item !== null) {
                $this->cache->set("items.$id", $item);
            } else {
                $this->cache->clear("items.$id");
            }
        }
        return $item;
    }

    public function delete(int $id): bool
    {
        $result = $this->model->delete($id);
        if ($result && $this->useCache && $this->cache) {
            $this->cache->clear('items.all');
            $this->cache->clear("items.$id");
        }
        return $result;
    }
}
