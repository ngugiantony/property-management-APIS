<?php

namespace App\Repositories;

use App\Models\Lease;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\LeaseRepositoryInterface;
use Carbon\Carbon;

class LeaseRepository extends BaseRepository implements LeaseRepositoryInterface
{
    public function __construct(Lease $model)
    {
        parent::__construct($model);
    }

    public function findByUnit(int $unitId, array $columns = ['*'])
    {
        return $this->model->where('unit_id', $unitId)->get($columns);
    }

    public function findByTenant(int $tenantId, array $columns = ['*'])
    {
        return $this->model->where('tenant_id', $tenantId)->get($columns);
    }

    public function findActive(array $columns = ['*'])
    {
        return $this->model->where('status', Lease::STATUS_ACTIVE)->get($columns);
    }

    public function findExpiringSoon(int $daysThreshold = 30, array $columns = ['*'])
    {
        $date = Carbon::now()->addDays($daysThreshold);
        return $this->model->where('status', Lease::STATUS_ACTIVE)
            ->whereDate('end_date', '<=', $date)
            ->get($columns);
    }

    public function findByStatus(string $status, array $columns = ['*'])
    {
        return $this->model->where('status', $status)->get($columns);
    }

    public function findWithPayments(int $id, array $columns = ['*'])
    {
        return $this->model->with('payments')->findOrFail($id, $columns);
    }
}