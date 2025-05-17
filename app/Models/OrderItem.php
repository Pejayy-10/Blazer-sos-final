<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'yearbook_platform_id',
        'quantity',
        'unit_price',
        'is_gift',
        'recipient_id',
        'gift_message',
        'purchase_type', // 'current_subscription', 'past_yearbook'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'is_gift' => 'boolean',
    ];

    /**
     * Get the order this item belongs to
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the yearbook platform for this order item
     */
    public function yearbookPlatform(): BelongsTo
    {
        return $this->belongsTo(YearbookPlatform::class);
    }

    /**
     * Get the recipient user (for gifts)
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    /**
     * Get the yearbook subscriptions associated with this order item
     */
    public function yearbook_subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(YearbookSubscription::class, 'order_item_yearbook_subscription');
    }

    /**
     * Determine if this order item is for a past yearbook
     */
    public function isPastYearbook(): bool
    {
        return $this->purchase_type === 'past_yearbook';
    }

    /**
     * Get the total for this order item
     */
    public function getTotalAttribute(): float
    {
        return $this->quantity * $this->unit_price;
    }
} 