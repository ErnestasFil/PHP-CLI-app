<?php

abstract class Model
{
    protected static $pdo;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct() {}
    public static function setConnection($pdo)
    {
        self::$pdo = $pdo;
    }

    public static function getAll()
    {
        $instance = new static();
        $sql = "SELECT * FROM {$instance->table}";

        $stmt = self::$pdo->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        $results = $stmt->fetchAll();
        return $results;
    }

    public static function findById($id)
    {
        $instance = new static();
        $sql = "SELECT * FROM {$instance->table} WHERE {$instance->primaryKey} = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function insert($data)
    {
        $instance = new static();
        $fields = array_keys($data);
        $placeholders = implode(',', array_fill(0, count($fields), '?'));
        $sql = "INSERT INTO {$instance->table} (" . implode(',', $fields) . ") VALUES ($placeholders)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute(array_values($data));
        return $stmt;
    }

  
}
