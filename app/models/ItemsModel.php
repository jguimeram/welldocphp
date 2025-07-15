<?php
namespace app\models;

class ItemsModel
{
    private static array $items = [
        1 => ['id' => 1, 'name' => 'Item 1'],
        2 => ['id' => 2, 'name' => 'Item 2'],
    ];

    public function all(): array
    {
        return array_values(self::$items);
    }

    public function find(int $id): ?array
    {
        return self::$items[$id] ?? null;
    }

    public function create(array $data): array
    {
        $id = empty(self::$items) ? 1 : max(array_keys(self::$items)) + 1;
        $data['id'] = $id;
        self::$items[$id] = $data;
        return $data;
    }

    public function update(int $id, array $data): ?array
    {
        if (!isset(self::$items[$id])) {
            return null;
        }
        self::$items[$id] = array_merge(self::$items[$id], $data);
        self::$items[$id]['id'] = $id;
        return self::$items[$id];
    }

    public function delete(int $id): bool
    {
        if (!isset(self::$items[$id])) {
            return false;
        }
        unset(self::$items[$id]);
        return true;
    }
}
