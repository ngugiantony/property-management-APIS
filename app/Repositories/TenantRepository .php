<?php

namespace App\Repositories;

use App\Models\Lease;
use App\Models\Tenant;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\TenantRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class TenantRepository extends BaseRepository implements TenantRepositoryInterface
{
    public function __construct(Tenant $model)
    {
        parent::__construct($model);
    }

    public function all(array $columns = ['*'])
    {
        return Cache::remember('tenants.all', 60 * 15, function () use ($columns) {
            return $this->model->all($columns);
        });
    }

    public function paginate(int $perPage = 15, array $columns = ['*'])
    {
        $page = request()->get('page', 1);
        return Cache::remember("tenants.paginate.{$perPage}.{$page}", 60 * 15, function () use ($perPage, $columns) {
            return $this->model->paginate($perPage, $columns);
        });
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function findWithActiveLeases(array $columns = ['*'])
    {
        return $this->model->whereHas('leases', function ($query) {
            $query->where('status', Lease::STATUS_ACTIVE);
        })->get($columns);
    }

    public function findWithExpiredLeases(array $columns = ['*'])
    {
        return $this->model->whereHas('leases', function ($query) {
            $query->where('status', Lease::STATUS_EXPIRED);
        })->get($columns);
    }

    public function create(array $data)
    {
        $result = parent::create($data);
        Cache::forget('tenants.all');
        return $result;
    }

    public function update(array $data, $id)
    {
        $result = parent::update($data, $id);
        Cache::forget('tenants.all');
        return $result;
    }

    public function delete($id)
    {
        $result = parent::delete($id);
        Cache::forget('tenants.all');
        return $result;
    }
}