<?php

require_once __DIR__ . '/../config/database.php';

class FailedPaymentRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all(): array
    {
        return $this->db
            ->query("SELECT * FROM failed_payments ORDER BY created_at DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM failed_payments");

        return (int) $stmt->fetchColumn();
    }
}
