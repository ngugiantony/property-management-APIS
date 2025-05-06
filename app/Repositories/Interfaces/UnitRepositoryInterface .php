<?php

namespace App\Repositories\Interfaces;

interface UnitRepositoryInterface extends RepositoryInterface
{
    public function findByProperty(int $propertyId, array $columns = ['*']);
    public function findByStatus(string $status, array $columns = ['*']);
    public function findVacant(array $columns = ['*']);
    public function findOccupied(array $columns = ['*']);
    public function findWithActiveLease(int $id, array $columns = ['*']);
}