<?php

require_once __DIR__ . '/../repositories/RouterRepository.php';

class RouterService
{
    private RouterRepository $repo;

    public function __construct()
    {
        $this->repo = new RouterRepository();
    }

    public function getAll(): array
    {
        return $this->repo->all();
    }

    public function create(string $router, string $ip, string $name): array
    {
        $router = trim($router);
        $ip = trim($ip);
        $name = trim($name);

        if ($router === '' || $ip === '' || $name === '') {
            return ['success' => false, 'error' => 'All fields are required.'];
        }

        try {
            $this->repo->create($router, $ip, $name);

            return ['success' => true, 'message' => 'Router created.'];
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Router already exists or could not be saved.'];
        }
    }

    public function update(int $id, string $router, string $ip, string $name): array
    {
        if (!$this->repo->find($id)) {
            return ['success' => false, 'error' => 'Router not found.'];
        }

        try {
            $this->repo->update($id, trim($router), trim($ip), trim($name));

            return ['success' => true, 'message' => 'Router updated.'];
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Could not update router.'];
        }
    }

    public function delete(int $id): void
    {
        $this->repo->delete($id);
    }
}
