<?php

abstract class Model
{
    protected static PDO $pdo;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct()
    {
    }

    public static function setConnection($pdo): void
    {
        self::$pdo = $pdo;
    }

    public static function getAll(): false|array
    {
        $instance = new static();
        $sql = "SELECT * FROM $instance->table";

        $stmt = self::$pdo->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $stmt->fetchAll();
    }

    public static function findById($id)
    {
        $instance = new static();
        $sql = "SELECT * FROM $instance->table WHERE $instance->primaryKey = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function insert($data): void
    {
        $instance = new static();
        $fields = array_keys($data);
        $placeholders = implode(',', array_fill(0, count($fields), '?'));
        $sql = "INSERT INTO $instance->table (" . implode(',', $fields) . ") VALUES ($placeholders)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(array_values($data));
    }

    public static function getCount(string $columnName, string $value): int
    {
        $instance = new static();
        $sql = "SELECT COUNT(*) FROM $instance->table WHERE $columnName = ?";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$value]);
        return $stmt->fetchColumn();
    }


    // public function delete($id)
    // {
    //     $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //     $stmt->execute();
    // }

    // public function findById($id)
    // {
    //     $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }


}
