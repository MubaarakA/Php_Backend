<?php

require_once __DIR__ . '/../services/PaymentService.php';

class PaymentController
{
    public function index(): void
    {
        $filter = $_GET['filter'] ?? null;
        $service = new PaymentService();
        $payments = $service->getAll($filter);
        $page = 'payments';

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/layout/sidebar.php';
        include __DIR__ . '/../views/payments.php';
        include __DIR__ . '/../views/layout/footer.php';
    }
}
