<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function findByRole(string $role, array $columns = ['*'])
    {
        return $this->model->where('role', $role)->get($columns);
    }
}