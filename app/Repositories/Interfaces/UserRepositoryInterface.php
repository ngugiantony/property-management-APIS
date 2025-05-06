<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email);
    public function findByRole(string $role, array $columns = ['*']);
}