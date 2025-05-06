<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'city',
        'state',
        'zip',
        'type',
        'owner_id',
        'description',
    ];

    /**
     * Get the owner of the property.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the units for the property.
     */
    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}