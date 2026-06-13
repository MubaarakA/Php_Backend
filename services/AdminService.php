<?php

require_once __DIR__ . '/../repositories/AdminRepository.php';

class AdminService
{
    private AdminRepository $repo;

    public function __construct()
    {
        $this->repo = new AdminRepository();
    }

    public function getAll(): array
    {
        return $this->repo->all();
    }

    public function login(string $username, string $password): array
    {
        $admin = $this->repo->findByUsername(trim($username));

        if (!$admin || !password_verify($password, $admin['password_hash'])) {
            return ['success' => false, 'error' => 'Invalid username or password.'];
        }

        return ['success' => true, 'admin' => $admin];
    }

    public function create(string $username, string $password): array
    {
        $username = trim($username);

        if ($username === '' || $password === '') {
            return ['success' => false, 'error' => 'Username and password are required.'];
        }

        if ($this->repo->findByUsername($username)) {
            return ['success' => false, 'error' => 'Username already exists.'];
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->repo->create($username, $hash);

        return ['success' => true, 'message' => 'Admin created.'];
    }

    public function delete(int $id, int $currentAdminId): array
    {
        if ($id === $currentAdminId) {
            return ['success' => false, 'error' => 'You cannot delete your own account.'];
        }

        if ($this->repo->count() <= 1) {
            return ['success' => false, 'error' => 'Cannot delete the last admin.'];
        }

        $this->repo->delete($id);

        return ['success' => true, 'message' => 'Admin deleted.'];
    }
}
