<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    const STATUS_PAID = 'paid';
    const STATUS_DUE = 'due';
    const STATUS_LATE = 'late';
    const STATUS_PARTIAL = 'partial';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lease_id',
        'amount',
        'payment_date',
        'due_date',
        'status',
        'payment_method',
        'reference_number',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
        'due_date' => 'date',
    ];

    /**
     * Get the lease that owns the payment.
     */
    public function lease()
    {
        return $this->belongsTo(Lease::class);
    }

    /**
     * Get the tenant associated with this payment.
     */
    public function tenant()
    {
        return $this->lease->tenant();
    }

    /**
     * Get the unit associated with this payment.
     */
    public function unit()
    {
        return $this->lease->unit();
    }

    /**
     * Check if the payment is paid.
     */
    public function isPaid()
    {
        return $this->status === self::STATUS_PAID;
    }

    /**
     * Check if the payment is due.
     */
    public function isDue()
    {
        return $this->status === self::STATUS_DUE;
    }

    /**
     * Check if the payment is late.
     */
    public function isLate()
    {
        return $this->status === self::STATUS_LATE;
    }
}