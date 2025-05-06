<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use Carbon\Carbon;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    public function findByLease(int $leaseId, array $columns = ['*'])
    {
        return $this->model->where('lease_id', $leaseId)->get($columns);
    }

    public function findByStatus(string $status, array $columns = ['*'])
    {
        return $this->model->where('status', $status)->get($columns);
    }

    public function findOverdue(array $columns = ['*'])
    {
        $today = Carbon::today();
        return $this->model->where('status', '!=', Payment::STATUS_PAID)
            ->whereDate('due_date', '<', $today)
            ->get($columns);
    }

    public function findDueToday(array $columns = ['*'])
    {
        $today = Carbon::today();
        return $this->model->where('status', '!=', Payment::STATUS_PAID)
            ->whereDate('due_date', $today)
            ->get($columns);
    }

    public function findDueThisWeek(array $columns = ['*'])
    {
        $today = Carbon::today();
        $endOfWeek = Carbon::today()->endOfWeek();
        return $this->model->where('status', '!=', Payment::STATUS_PAID)
            ->whereDate('due_date', '>=', $today)
            ->whereDate('due_date', '<=', $endOfWeek)
            ->get($columns);
    }

    public function findDueThisMonth(array $columns = ['*'])
    {
        $today = Carbon::today();
        $endOfMonth = Carbon::today()->endOfMonth();
        return $this->model->where('status', '!=', Payment::STATUS_PAID)
            ->whereDate('due_date', '>=', $today)
            ->whereDate('due_date', '<=', $endOfMonth)
            ->get($columns);
    }
}