<?php

require_once __DIR__ . '/../services/FailedPaymentService.php';

class FailedPaymentController
{
    public function index(): void
    {
        $service = new FailedPaymentService();
        $failedPayments = $service->getAll();
        $page = 'failed-payments';

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/layout/sidebar.php';
        include __DIR__ . '/../views/failed-payments.php';
        include __DIR__ . '/../views/layout/footer.php';
    }
}
