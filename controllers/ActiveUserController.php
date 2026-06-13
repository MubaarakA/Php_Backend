<?php

require_once __DIR__ . '/../services/ActiveUserService.php';

class ActiveUserController
{
    public function index(): void
    {
        $service = new ActiveUserService();
        $activeUsers = $service->getAll();
        $page = 'active-users';

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/layout/sidebar.php';
        include __DIR__ . '/../views/active-users.php';
        include __DIR__ . '/../views/layout/footer.php';
    }
}
