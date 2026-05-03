<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'address',
        'price',
        'type',
        'status',
        'bedrooms',
        'bathrooms',
        'lot_area',
        'floor_area',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}