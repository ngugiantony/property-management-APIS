<?php

namespace App\Repositories;

use App\Models\Property;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\PropertyRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class PropertyRepository extends BaseRepository implements PropertyRepositoryInterface
{
    public function __construct(Property $model)
    {
        parent::__construct($model);
    }

    public function all(array $columns = ['*'])
    {
        return Cache::remember('properties.all', 60 * 15, function () use ($columns) {
            return $this->model->all($columns);
        });
    }

    public function paginate(int $perPage = 15, array $columns = ['*'])
    {
        $page = request()->get('page', 1);
        return Cache::remember("properties.paginate.{$perPage}.{$page}", 60 * 15, function () use ($perPage, $columns) {
            return $this->model->paginate($perPage, $columns);
        });
    }

    public function findByOwner(int $ownerId, array $columns = ['*'])
    {
        return $this->model->where('owner_id', $ownerId)->get($columns);
    }

    public function findByCity(string $city, array $columns = ['*'])
    {
        return $this->model->where('city', $city)->get($columns);
    }

    public function findByState(string $state, array $columns = ['*'])
    {
        return $this->model->where('state', $state)->get($columns);
    }

    public function findByType(string $type, array $columns = ['*'])
    {
        return $this->model->where('type', $type)->get($columns);
    }

    public function findWithUnits(int $id, array $columns = ['*'])
    {
        return $this->model->with('units')->findOrFail($id, $columns);
    }

    public function create(array $data)
    {
        $result = parent::create($data);
        Cache::forget('properties.all');
        return $result;
    }

    public function update(array $data, $id)
    {
        $result = parent::update($data, $id);
        Cache::forget('properties.all');
        return $result;
    }

    public function delete($id)
    {
        $result = parent::delete($id);
        Cache::forget('properties.all');
        return $result;
    }
}