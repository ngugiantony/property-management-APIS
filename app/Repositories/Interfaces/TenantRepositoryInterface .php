<?php

namespace App\Repositories\Interfaces;

interface TenantRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email);
    public function findWithActiveLeases(array $columns = ['*']);
    public function findWithExpiredLeases(array $columns = ['*']);
}