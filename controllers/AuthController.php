<?php

require_once __DIR__ . '/../services/AdminService.php';

class AuthController
{
    public function showLogin(): void
    {
        if (auth_check()) {
            header('Location: index.php?page=dashboard');
            exit;
        }

        include __DIR__ . '/../views/login.php';
    }

    public function login(): void
    {
        $service = new AdminService();

        $result = $service->login(
            $_POST['username'] ?? '',
            $_POST['password'] ?? ''
        );

        if (!$result['success']) {
            flash_set('danger', $result['error']);
            header('Location: index.php?page=login');
            exit;
        }

        auth_login($result['admin']);
        header('Location: index.php?page=dashboard');
        exit;
    }

    public function logout(): void
    {
        auth_logout();
        header('Location: index.php?page=login');
        exit;
    }
}
