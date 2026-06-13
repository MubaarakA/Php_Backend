<?php

require_once __DIR__ . '/../services/AuthLogService.php';

class LogController
{
    public function index(): void
    {
        $filter = $_GET['filter'] ?? null;
        $service = new AuthLogService();
        $logs = $service->getAll($filter);
        $page = 'logs';

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/layout/sidebar.php';
        include __DIR__ . '/../views/logs.php';
        include __DIR__ . '/../views/layout/footer.php';
    }
}
