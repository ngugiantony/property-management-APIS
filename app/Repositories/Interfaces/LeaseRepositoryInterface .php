<?php

namespace App\Repositories\Interfaces;

interface LeaseRepositoryInterface extends RepositoryInterface
{
    public function findByUnit(int $unitId, array $columns = ['*']);
    public function findByTenant(int $tenantId, array $columns = ['*']);
    public function findActive(array $columns = ['*']);
    public function findExpiringSoon(int $daysThreshold = 30, array $columns = ['*']);
    public function findByStatus(string $status, array $columns = ['*']);
    public function findWithPayments(int $id, array $columns = ['*']);
}