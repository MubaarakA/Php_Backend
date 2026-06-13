<?php

require_once __DIR__ . '/../config/database.php';

class RadiusUserRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function exists(string $username): bool
    {
        $stmt = $this->db->prepare(
            "SELECT id FROM radcheck WHERE username = ? LIMIT 1"
        );
        $stmt->execute([$username]);

        return $stmt->rowCount() > 0;
    }

    public function all(): array
    {
        $sql = "
            SELECT
                r.username,
                MAX(CASE WHEN r.attribute = 'Cleartext-Password' THEN r.value END) AS password,
                MAX(CASE WHEN r.attribute = 'Expiration' THEN r.value END) AS expiration,
                ROUND(IFNULL(stats.upload, 0) / 1024 / 1024, 2) AS upload,
                ROUND(IFNULL(stats.download, 0) / 1024 / 1024, 2) AS download,
                MAX(CASE WHEN rr.attribute = 'Mikrotik-Rate-Limit' THEN rr.value END) AS speed,
                CASE WHEN online.username IS NOT NULL THEN 'online' ELSE 'offline' END AS status
            FROM radcheck r
            LEFT JOIN radreply rr ON r.username = rr.username
            LEFT JOIN (
                SELECT username, SUM(acctinputoctets) AS upload, SUM(acctoutputoctets) AS download
                FROM radacct GROUP BY username
            ) stats ON r.username = stats.username
            LEFT JOIN (
                SELECT DISTINCT username FROM radacct WHERE acctstoptime IS NULL
            ) online ON r.username = online.username
            GROUP BY r.username
            ORDER BY r.username
        ";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count(): int
    {
        $stmt = $this->db->query(
            "SELECT COUNT(DISTINCT username) FROM radcheck WHERE attribute = 'Cleartext-Password'"
        );

        return (int) $stmt->fetchColumn();
    }

    public function insertPassword(string $username, string $password): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO radcheck (username, attribute, op, value) VALUES (?, 'Cleartext-Password', ':=', ?)"
        );
        $stmt->execute([$username, $password]);
    }

    public function insertExpiration(string $username, string $expiration): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO radcheck (username, attribute, op, value) VALUES (?, 'Expiration', ':=', ?)"
        );
        $stmt->execute([$username, $expiration]);
    }

    public function insertSimultaneousUse(string $username): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO radcheck (username, attribute, op, value) VALUES (?, 'Simultaneous-Use', ':=', '1')"
        );
        $stmt->execute([$username]);
    }

    public function insertSpeed(string $username, string $speed): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO radreply (username, attribute, op, value) VALUES (?, 'Mikrotik-Rate-Limit', '=', ?)"
        );
        $stmt->execute([$username, $speed]);
    }

    public function delete(string $username): void
    {
        $stmt = $this->db->prepare("DELETE FROM radcheck WHERE username = ?");
        $stmt->execute([$username]);

        $stmt = $this->db->prepare("DELETE FROM radreply WHERE username = ?");
        $stmt->execute([$username]);
    }

    public function getDb(): PDO
    {
        return $this->db;
    }
}
