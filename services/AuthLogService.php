<?php

require_once __DIR__ . '/../repositories/AuthLogRepository.php';

class AuthLogService
{
    private AuthLogRepository $repo;

    public function __construct()
    {
        $this->repo = new AuthLogRepository();
    }

    public function getAll(?string $filter = null): array
    {
        return $this->repo->all($filter);
    }
}
