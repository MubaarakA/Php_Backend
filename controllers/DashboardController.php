<?php

require_once __DIR__ . '/../services/DashboardService.php';

class DashboardController
{
    public function index(): void
    {
        $service = new DashboardService();
        $stats = $service->getStats();
        $page = 'dashboard';

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/layout/sidebar.php';
        include __DIR__ . '/../views/dashboard.php';
        include __DIR__ . '/../views/layout/footer.php';
    }
}
