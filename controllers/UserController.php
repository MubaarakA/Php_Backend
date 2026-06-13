<?php

require_once __DIR__ . '/../services/UserService.php';
require_once __DIR__ . '/../services/SpeedService.php';

class UserController
{
    public function index(): void
    {
        $userService = new UserService();
        $speedService = new SpeedService();

        $users = $userService->getAll();
        $speeds = $speedService->getAll();
        $page = 'users';

        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/layout/sidebar.php';
        include __DIR__ . '/../views/users.php';
        include __DIR__ . '/../views/layout/footer.php';
    }

    public function store(): void
    {
        $service = new UserService();

        $result = $service->createUser(
            $_POST['phone'] ?? '',
            $_POST['password'] ?? '',
            $_POST['expiration'] ?? '',
            $_POST['speed'] ?? ''
        );

        if ($result['success']) {
            flash_set('success', $result['message']);
        } else {
            flash_set('danger', $result['error']);
        }

        header('Location: index.php?page=users');
        exit;
    }

    public function destroy(): void
    {
        $username = $_GET['user'] ?? '';

        if ($username !== '') {
            $service = new UserService();
            $service->deleteUser($username);
            flash_set('success', 'User deleted.');
        }

        header('Location: index.php?page=users');
        exit;
    }
}
