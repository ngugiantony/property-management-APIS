<?php

namespace App\Repositories;

use App\Models\Unit;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\UnitRepositoryInterface;

class UnitRepository extends BaseRepository implements UnitRepositoryInterface
{
    public function __construct(Unit $model)
    {
        parent::__construct($model);
    }

    public function findByProperty(int $propertyId, array $columns = ['*'])
    {
        return $this->model->where('property_id', $propertyId)->get($columns);
    }

    public function findByStatus(string $status, array $columns = ['*'])
    {
        return $this->model->where('status', $status)->get($columns);
    }

    public function findVacant(array $columns = ['*'])
    {
        return $this->model->where('status', Unit::STATUS_VACANT)->get($columns);
    }

    public function findOccupied(array $columns = ['*'])
    {
        return $this->model->where('status', Unit::STATUS_OCCUPIED)->get($columns);
    }

    public function findWithActiveLease(int $id, array $columns = ['*'])
    {
        return $this->model->with(['leases' => function ($query) {
            $query->where('status', 'active');
        }])->findOrFail($id, $columns);
    }
}