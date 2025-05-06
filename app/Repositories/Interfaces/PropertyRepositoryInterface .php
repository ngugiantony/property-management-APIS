<?php

namespace App\Repositories\Interfaces;

interface PropertyRepositoryInterface extends RepositoryInterface
{
    public function findByOwner(int $ownerId, array $columns = ['*']);
    public function findByCity(string $city, array $columns = ['*']);
    public function findByState(string $state, array $columns = ['*']);
    public function findByType(string $type, array $columns = ['*']);
    public function findWithUnits(int $id, array $columns = ['*']);
}