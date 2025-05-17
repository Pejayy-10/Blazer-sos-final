<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'payment_proof',
        'student_id_proof',
        'processed_by',
        'processed_at',
        'claimed_processed_by',
        'claimed_at',
        'admin_notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'processed_at' => 'datetime',
        'claimed_at' => 'datetime',
    ];

    /**
     * Get the user who placed this order
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the processor for this order
     */
    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Get the claim processor for this order
     */
    public function claimProcessor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'claimed_processed_by');
    }

    /**
     * Get the order items in this order
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Check if this order is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if this order is ready for claim
     */
    public function isReadyForClaim(): bool
    {
        return $this->status === 'ready_for_claim';
    }

    /**
     * Check if this order is claimed
     */
    public function isClaimed(): bool
    {
        return $this->status === 'claimed';
    }

    /**
     * Mark this order as completed and update related records
     */
    public function markAsCompleted()
    {
        // Update order status
        $this->status = 'completed';
        $this->save();

        // Update all yearbook subscriptions linked to order items
        foreach ($this->items as $orderItem) {
            foreach ($orderItem->yearbook_subscriptions as $subscription) {
                $subscription->payment_status = 'paid';
                $subscription->paid_at = now();
                $subscription->save();
            }

            // Update stock for past yearbooks
            if ($orderItem->isPastYearbook()) {
                $platform = $orderItem->yearbookPlatform;
                if ($platform && $platform->stock) {
                    $platform->stock->available_stock -= $orderItem->quantity;
                    $platform->stock->save();
                }
            }
        }

        return $this;
    }

    /**
     * Get the order reference/number
     */
    public function getOrderReferenceAttribute()
    {
        // Format: YB-{YY}-{ID}
        return 'YB-' . date('y') . '-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
} 