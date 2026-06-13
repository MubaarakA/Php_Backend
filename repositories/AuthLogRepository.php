<?php

require_once __DIR__ . '/../config/database.php';

class AuthLogRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all(?string $filter = null): array
    {
        $sql = "SELECT username, reply, authdate FROM radpostauth";
        $params = [];

        if ($filter === 'reject') {
            $sql .= " WHERE reply = 'Access-Reject'";
        }

        $sql .= " ORDER BY authdate DESC LIMIT 500";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countRejections(): int
    {
        $stmt = $this->db->query(
            "SELECT COUNT(*) FROM radpostauth WHERE reply = 'Access-Reject'"
        );

        return (int) $stmt->fetchColumn();
    }
}
