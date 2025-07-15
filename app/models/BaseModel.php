<?php
namespace app\models;

use app\core\Database;
use PDO;

abstract class BaseModel
{
    protected string $table;

    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function create(array $data): array
    {
        $columns = array_keys($data);
        $placeholders = array_map(fn($c) => ':' . $c, $columns);
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->table,
            implode(',', $columns),
            implode(',', $placeholders)
        );
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        $id = (int)$this->db->lastInsertId();
        return $this->find($id);
    }

    public function update(int $id, array $data): ?array
    {
        $assignments = implode(',', array_map(fn($c) => "$c = :$c", array_keys($data)));
        $data['id'] = $id;
        $sql = sprintf('UPDATE %s SET %s WHERE id = :id', $this->table, $assignments);
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute($data)) {
            return $this->find($id);
        }
        return null;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
