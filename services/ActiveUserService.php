<?php

require_once __DIR__ . '/../repositories/ActiveUserRepository.php';

class ActiveUserService
{
    private ActiveUserRepository $repo;

    public function __construct()
    {
        $this->repo = new ActiveUserRepository();
    }

    public function getAll(): array
    {
        $users = $this->repo->all();

        foreach ($users as &$user) {
            $user['time_left'] = $this->calculateTimeLeft($user['expiration'] ?? null);
        }

        return $users;
    }

    private function calculateTimeLeft(?string $expiration): string
    {
        if (!$expiration) {
            return '—';
        }

        $expTime = strtotime($expiration);
        if ($expTime === false) {
            return '—';
        }

        $diff = $expTime - time();

        if ($diff <= 0) {
            return 'Expired';
        }

        $hours = floor($diff / 3600);
        $minutes = floor(($diff % 3600) / 60);

        if ($hours > 0) {
            return "{$hours}h {$minutes}m";
        }

        return "{$minutes}m";
    }
}
