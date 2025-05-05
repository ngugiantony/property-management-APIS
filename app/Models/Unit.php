<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    const STATUS_VACANT = 'vacant';
    const STATUS_OCCUPIED = 'occupied';
    const STATUS_MAINTENANCE = 'maintenance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'property_id',
        'unit_number',
        'bedrooms',
        'bathrooms',
        'square_feet',
        'rent_amount',
        'status',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'bedrooms' => 'integer',
        'bathrooms' => 'float',
        'square_feet' => 'integer',
        'rent_amount' => 'decimal:2',
    ];

    /**
     * Get the property that owns the unit.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the leases for the unit.
     */
    public function leases()
    {
        return $this->hasMany(Lease::class);
    }

    /**
     * Get the active lease for the unit.
     */
    public function activeLease()
    {
        return $this->leases()->where('status', Lease::STATUS_ACTIVE)->first();
    }

    /**
     * Check if the unit is vacant.
     */
    public function isVacant()
    {
        return $this->status === self::STATUS_VACANT;
    }
}