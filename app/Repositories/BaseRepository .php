<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function find($id, array $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function findBy(array $criteria, array $columns = ['*'])
    {
        return $this->model->where($criteria)->get($columns);
    }

    public function paginate(int $perPage = 15, array $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}