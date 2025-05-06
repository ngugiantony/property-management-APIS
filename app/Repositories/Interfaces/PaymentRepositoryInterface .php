<?php

namespace App\Repositories\Interfaces;

interface PaymentRepositoryInterface extends RepositoryInterface
{
    public function findByLease(int $leaseId, array $columns = ['*']);
    public function findByStatus(string $status, array $columns = ['*']);
    public function findOverdue(array $columns = ['*']);
    public function findDueToday(array $columns = ['*']);
    public function findDueThisWeek(array $columns = ['*']);
    public function findDueThisMonth(array $columns = ['*']);
}