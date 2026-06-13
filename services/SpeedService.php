<?php

require_once __DIR__ . '/../repositories/SpeedRepository.php';

class SpeedService
{
    private SpeedRepository $repo;

    public function __construct()
    {
        $this->repo = new SpeedRepository();
    }

    public function getAll(): array
    {
        return $this->repo->all();
    }
}
