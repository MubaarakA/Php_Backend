<?php

require_once __DIR__ . '/../repositories/RadiusUserRepository.php';
require_once __DIR__ . '/../repositories/SpeedRepository.php';

class UserService
{
    private RadiusUserRepository $users;
    private SpeedRepository $speeds;

    public function __construct()
    {
        $this->users = new RadiusUserRepository();
        $this->speeds = new SpeedRepository();
    }

    public function getAll(): array
    {
        return $this->users->all();
    }

    public function createUser(
        string $phone,
        string $password,
        string $expirationInput,
        string $speed
    ): array {
        $phone = trim($phone);
        $password = trim($password);
        $speed = trim($speed);

        if ($phone === '' || $password === '' || $expirationInput === '' || $speed === '') {
            return ['success' => false, 'error' => 'All fields are required.'];
        }

        if ($this->users->exists($phone)) {
            return ['success' => false, 'error' => 'User already exists'];
        }

        if (!$this->speeds->findByValue($speed)) {
            return ['success' => false, 'error' => 'Invalid speed selected.'];
        }

        $expiration = $this->formatExpiration($expirationInput);
        if ($expiration === null) {
            return ['success' => false, 'error' => 'Invalid expiration date.'];
        }

        $db = $this->users->getDb();

        try {
            $db->beginTransaction();

            $this->users->insertPassword($phone, $password);
            $this->users->insertExpiration($phone, $expiration);
            $this->users->insertSimultaneousUse($phone);
            $this->users->insertSpeed($phone, $speed);

            $db->commit();

            return ['success' => true, 'message' => 'User created successfully.'];
        } catch (Exception $e) {
            $db->rollBack();

            return ['success' => false, 'error' => 'Failed to create user.'];
        }
    }

    public function deleteUser(string $username): void
    {
        $this->users->delete(trim($username));
    }

    private function formatExpiration(string $input): ?string
    {
        $timestamp = strtotime($input);

        if ($timestamp === false) {
            return null;
        }

        return date('d M Y H:i:s', $timestamp);
    }
}
