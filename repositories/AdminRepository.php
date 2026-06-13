<?php

require_once __DIR__ . '/../config/database.php';

class AdminRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all(): array
    {
        return $this->db
            ->query("SELECT id, username FROM admins ORDER BY username")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    public function create(string $username, string $passwordHash): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO admins (username, password_hash) VALUES (?, ?)"
        );
        $stmt->execute([$username, $passwordHash]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM admins WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function count(): int
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM admins");

        return (int) $stmt->fetchColumn();
    }
}
