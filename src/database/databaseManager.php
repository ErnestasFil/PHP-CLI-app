<?php

class DatabaseManager
{
    private PDO $pdo;

    public function __construct($dbFilePath)
    {
        try {
            $this->pdo = new PDO("sqlite:" . $dbFilePath);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->enableForeignKeySupport();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    private function enableForeignKeySupport(): void
    {
        $this->pdo->exec("PRAGMA foreign_keys = ON;");
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }

    public function createTables(): void
    {
        $charityTable = "CREATE TABLE IF NOT EXISTS charities (
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            name TEXT NOT NULL,
                            email TEXT NOT NULL
                        );";

        $donationTable = "CREATE TABLE IF NOT EXISTS donations (
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            donor_name TEXT NOT NULL,
                            amount REAL NOT NULL,
                            charity_id INTEGER NOT NULL,
                            date_time TEXT NOT NULL,
                            FOREIGN KEY (charity_id) REFERENCES charities(id) ON DELETE CASCADE
                     );";

        $this->pdo->exec($charityTable);
        $this->pdo->exec($donationTable);
    }
}
