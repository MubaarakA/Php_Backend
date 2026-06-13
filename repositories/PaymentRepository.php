<?php

require_once __DIR__ . '/../config/database.php';

class PaymentRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all(?string $filter = null): array
    {
        $sql = "SELECT * FROM payments";
        $params = [];

        if ($filter === 'today') {
            $sql .= " WHERE DATE(created_at) = CURDATE()";
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalRevenue(): float
    {
        $stmt = $this->db->query("SELECT IFNULL(SUM(amount), 0) FROM payments");

        return (float) $stmt->fetchColumn();
    }

    public function todayRevenue(): float
    {
        $stmt = $this->db->query(
            "SELECT IFNULL(SUM(amount), 0) FROM payments WHERE DATE(created_at) = CURDATE()"
        );

        return (float) $stmt->fetchColumn();
    }
}
