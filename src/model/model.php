<?php

abstract class Model
{
    protected static PDO $pdo;
    protected string $table;
    protected string $primaryKey = 'id';

    public function __construct(string $table = '')
    {
        $this->table = $table ?: $this->table;
    }

    public static function setConnection(PDO $pdo): void
    {
        self::$pdo = $pdo;
    }

    public static function getAll(): array|false
    {
        $instance = new static();
        $sql = "SELECT * FROM $instance->table";
        return self::query($sql, [], true);
    }

    protected static function query(string $sql, array $params = [], bool $fetchAll = false): array|false
    {
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);
        return $fetchAll ? $stmt->fetchAll(PDO::FETCH_CLASS, static::class) : $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id): array|false
    {
        $instance = new static();
        $sql = "SELECT * FROM $instance->table WHERE $instance->primaryKey = :id";
        return self::query($sql, ['id' => $id]);
    }

    public static function insert(array $data): void
    {
        $instance = new static();
        $fields = array_keys($data);
        $placeholders = implode(',', array_fill(0, count($fields), '?'));
        $sql = "INSERT INTO $instance->table (" . implode(',', $fields) . ") VALUES ($placeholders)";
        self::query($sql, array_values($data));
    }

    public static function getCount(string $columnName, string $value): int
    {
        $instance = new static();
        $sql = "SELECT COUNT(*) FROM $instance->table WHERE $columnName = ?";
        $result = self::query($sql, [$value]);
        return $result ? (int)array_values($result)[0] : 0;
    }

    public static function updateById(int $id, array $data): void
    {
        $instance = new static();
        $fields = array_keys($data);
        $setClause = implode(', ', array_map(fn($field) => "$field = ?", $fields));
        $sql = "UPDATE $instance->table SET $setClause WHERE $instance->primaryKey = ?";
        self::query($sql, [...array_values($data), $id]);
    }

    public static function deleteById(int $id): void
    {
        $instance = new static();
        $sql = "DELETE FROM $instance->table WHERE $instance->primaryKey = ?";
        self::query($sql, [$id]);
    }
}
