<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function all(array $columns = ['*']);
    public function find($id, array $columns = ['*']);
    public function findBy(array $criteria, array $columns = ['*']);
    public function paginate(int $perPage = 25, array $columns = ['*']);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}