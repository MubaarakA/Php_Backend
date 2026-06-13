<?php

require_once __DIR__ . '/../services/AdminService.php';

class AdminController
{
    public function index(): void
    {
        $service = new AdminService();
        $admins = $service->getAll();
        $page = 'admins';

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/layout/sidebar.php';
        include __DIR__ . '/../views/admins.php';
        include __DIR__ . '/../views/layout/footer.php';
    }

    public function store(): void
    {
        $service = new AdminService();

        $result = $service->create(
            $_POST['username'] ?? '',
            $_POST['password'] ?? ''
        );

        flash_set($result['success'] ? 'success' : 'danger', $result['message'] ?? $result['error']);
        header('Location: index.php?page=admins');
        exit;
    }

    public function destroy(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $current = auth_user();

        if ($id > 0 && $current) {
            $service = new AdminService();
            $result = $service->delete($id, (int) $current['id']);
            flash_set($result['success'] ? 'success' : 'danger', $result['message'] ?? $result['error']);
        }

        header('Location: index.php?page=admins');
        exit;
    }
}
