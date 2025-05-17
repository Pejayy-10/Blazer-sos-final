<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'yearbook_platform_id',
        'quantity',
        'unit_price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
    ];

    /**
     * Get the user this item belongs to
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the yearbook platform for this cart item
     */
    public function yearbookPlatform(): BelongsTo
    {
        return $this->belongsTo(YearbookPlatform::class);
    }

    /**
     * Get the total for this cart item
     */
    public function getTotalAttribute(): float
    {
        return $this->quantity * $this->unit_price;
    }
} 