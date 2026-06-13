<?php

require_once __DIR__ . '/../config/database.php';

class SpeedRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all(): array
    {
        return $this->db
            ->query("SELECT * FROM speeds ORDER BY id")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByValue(string $value): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM speeds WHERE value = ?");
        $stmt->execute([$value]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }
}
