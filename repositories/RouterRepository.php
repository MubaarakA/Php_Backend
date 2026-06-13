<?php

require_once __DIR__ . '/../config/database.php';

class RouterRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function all(): array
    {
        return $this->db
            ->query("SELECT * FROM routers ORDER BY router")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM routers WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    public function create(string $router, string $ip, string $name): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO routers (router, ip, name) VALUES (?, ?, ?)"
        );
        $stmt->execute([$router, $ip, $name]);
    }

    public function update(int $id, string $router, string $ip, string $name): void
    {
        $stmt = $this->db->prepare(
            "UPDATE routers SET router = ?, ip = ?, name = ? WHERE id = ?"
        );
        $stmt->execute([$router, $ip, $name, $id]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM routers WHERE id = ?");
        $stmt->execute([$id]);
    }
}
