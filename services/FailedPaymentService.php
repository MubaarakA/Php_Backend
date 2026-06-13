<?php

require_once __DIR__ . '/../repositories/FailedPaymentRepository.php';

class FailedPaymentService
{
    private FailedPaymentRepository $repo;

    public function __construct()
    {
        $this->repo = new FailedPaymentRepository();
    }

    public function getAll(): array
    {
        return $this->repo->all();
    }
}
