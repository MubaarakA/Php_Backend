<?php

require_once __DIR__ . '/../services/RouterService.php';

class RouterController
{
    public function index(): void
    {
        $service = new RouterService();
        $routers = $service->getAll();
        $page = 'routers';

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/layout/sidebar.php';
        include __DIR__ . '/../views/routers.php';
        include __DIR__ . '/../views/layout/footer.php';
    }

    public function store(): void
    {
        $service = new RouterService();

        $result = $service->create(
            $_POST['router'] ?? '',
            $_POST['ip'] ?? '',
            $_POST['name'] ?? ''
        );

        flash_set($result['success'] ? 'success' : 'danger', $result['message'] ?? $result['error']);
        header('Location: index.php?page=routers');
        exit;
    }

    public function update(): void
    {
        $service = new RouterService();

        $result = $service->update(
            (int) ($_POST['id'] ?? 0),
            $_POST['router'] ?? '',
            $_POST['ip'] ?? '',
            $_POST['name'] ?? ''
        );

        flash_set($result['success'] ? 'success' : 'danger', $result['message'] ?? $result['error']);
        header('Location: index.php?page=routers');
        exit;
    }

    public function destroy(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id > 0) {
            $service = new RouterService();
            $service->delete($id);
            flash_set('success', 'Router deleted.');
        }

        header('Location: index.php?page=routers');
        exit;
    }
}
