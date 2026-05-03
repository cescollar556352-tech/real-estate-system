<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'property_id',
        'client_id',
        'user_id',
        'type',
        'transaction_date',
        'amount',
        'lease_start_date',
        'lease_end_date',
        'security_deposit',
        'contract_reference',
        'status',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'lease_start_date' => 'date',
        'lease_end_date'   => 'date',
        'amount'           => 'decimal:2',
        'security_deposit' => 'decimal:2',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isRental(): bool
    {
        return $this->type === 'rent';
    }

    public function statusBadgeStyle(): string
    {
        return match ($this->status) {
            'completed' => 'background-color:#dcfce7;color:#15803d;',
            'cancelled' => 'background-color:#fee2e2;color:#dc2626;',
            default     => 'background-color:#fef9c3;color:#92400e;',
        };
    }

    public function typeBadgeStyle(): string
    {
        return match ($this->type) {
            'buy'   => 'background-color:#dcfce7;color:#15803d;',
            'sell'  => 'background-color:#ede9fe;color:#7c3aed;',
            default => 'background-color:#dbeafe;color:#1d4ed8;',
        };
    }
}