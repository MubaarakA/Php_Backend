<?php

require_once __DIR__ . '/../repositories/PaymentRepository.php';

class PaymentService
{
    private PaymentRepository $repo;

    public function __construct()
    {
        $this->repo = new PaymentRepository();
    }

    public function getAll(?string $filter = null): array
    {
        return $this->repo->all($filter);
    }
}
