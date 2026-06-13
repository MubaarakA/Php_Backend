<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function auth_check(): bool
{
    return isset($_SESSION['admin_id']);
}

function auth_require(): void
{
    if (!auth_check()) {
        header('Location: index.php?page=login');
        exit;
    }
}

function auth_user(): ?array
{
    if (!auth_check()) {
        return null;
    }

    return [
        'id' => $_SESSION['admin_id'],
        'username' => $_SESSION['admin_username'],
    ];
}

function auth_login(array $admin): void
{
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_username'] = $admin['username'];
}

function auth_logout(): void
{
    session_destroy();
}
