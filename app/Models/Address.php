<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'street_address',
        'city',
        'province_state',
        'zip_code',
        'country',
        'is_primary',
        'address_type', // 'shipping', 'billing', 'both'
    ];

    /**
     * Get the user that owns the address.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get a formatted string of the address.
     */
    public function getFormattedAddressAttribute(): string
    {
        $parts = [
            $this->street_address,
            $this->city,
            $this->province_state,
            $this->zip_code,
            $this->country
        ];
        
        return implode(', ', array_filter($parts));
    }
} 