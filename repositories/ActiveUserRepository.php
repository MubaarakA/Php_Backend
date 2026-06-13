<?php

require_once __DIR__ . '/../config/database.php';

class ActiveUserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all(): array
    {
        $sql = "
            SELECT
                active.username,
                active.framedipaddress,
                active.acctstarttime,
                ROUND(IFNULL(total.download, 0) / 1024 / 1024, 2) AS download,
                ROUND(IFNULL(total.upload, 0) / 1024 / 1024, 2) AS upload,
                exp.expiration
            FROM (
                SELECT username, framedipaddress, acctstarttime
                FROM radacct
                WHERE acctstoptime IS NULL
            ) active
            LEFT JOIN (
                SELECT username, SUM(acctinputoctets) AS upload, SUM(acctoutputoctets) AS download
                FROM radacct GROUP BY username
            ) total ON active.username = total.username
            LEFT JOIN (
                SELECT username, value AS expiration
                FROM radcheck
                WHERE attribute = 'Expiration'
            ) exp ON active.username = exp.username
            ORDER BY active.acctstarttime DESC
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count(): int
    {
        $stmt = $this->db->query(
            "SELECT COUNT(DISTINCT username) FROM radacct WHERE acctstoptime IS NULL"
        );

        return (int) $stmt->fetchColumn();
    }
}
