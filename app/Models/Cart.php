<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status', // 'active', 'converted_to_order', 'abandoned'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the user who owns this cart
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cart items in this cart
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Calculate the total amount based on cart items
     */
    public function calculateTotal()
    {
        $total = $this->cartItems->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });
        
        $this->total_amount = $total;
        $this->save();
        
        return $total;
    }

    /**
     * Add a yearbook to the cart
     */
    public function addYearbookToCart(
        YearbookPlatform $platform, 
        $quantity = 1, 
        $isGift = false, 
        $recipientId = null, 
        $giftMessage = null
    ) {
        // Check if platform is available
        if (!$platform->allowsSubscription()) {
            throw new \Exception('This yearbook is not available for purchase.');
        }

        // Check stock if it's a past yearbook
        if ($platform->isPastYear() && !$platform->hasAvailableStock()) {
            throw new \Exception('This yearbook is out of stock.');
        }

        // Get price from stock
        $price = $platform->stock->price ?? 2300.00;

        // Check if similar item exists in cart
        $existingItem = $this->cartItems()
            ->where('yearbook_platform_id', $platform->id)
            ->where('is_gift', $isGift)
            ->where('recipient_id', $recipientId)
            ->first();

        if ($existingItem) {
            // Update existing item quantity
            $existingItem->quantity += $quantity;
            $existingItem->save();
            $this->calculateTotal();
            return $existingItem;
        }

        // Create new cart item
        $cartItem = $this->cartItems()->create([
            'yearbook_platform_id' => $platform->id,
            'quantity' => $quantity,
            'unit_price' => $price,
            'is_gift' => $isGift,
            'recipient_id' => $recipientId,
            'gift_message' => $giftMessage,
            'purchase_type' => $platform->isPastYear() ? 'past_yearbook' : 'current_subscription',
        ]);

        $this->calculateTotal();
        return $cartItem;
    }

    /**
     * Get an active cart for a user or create one
     */
    public static function getOrCreateCart($userId)
    {
        $cart = self::where('user_id', $userId)
            ->where('status', 'active')
            ->first();

        if (!$cart) {
            $cart = self::create([
                'user_id' => $userId,
                'total_amount' => 0,
                'status' => 'active',
            ]);
        }

        return $cart;
    }

    /**
     * Convert this cart to an order
     */
    public function convertToOrder()
    {
        // Create a new order
        $order = Order::create([
            'user_id' => $this->user_id,
            'total_amount' => $this->total_amount,
            'status' => 'pending',
        ]);

        // Transfer cart items to order items
        foreach ($this->cartItems as $cartItem) {
            // Create order item
            $orderItem = $order->orderItems()->create([
                'yearbook_platform_id' => $cartItem->yearbook_platform_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
                'is_gift' => $cartItem->is_gift,
                'recipient_id' => $cartItem->recipient_id,
                'gift_message' => $cartItem->gift_message,
                'purchase_type' => $cartItem->purchase_type,
            ]);

            // Create yearbook subscription for each item
            for ($i = 0; $i < $cartItem->quantity; $i++) {
                $yearbook = YearbookSubscription::create([
                    'user_id' => $this->user_id,
                    'yearbook_platform_id' => $cartItem->yearbook_platform_id,
                    'payment_status' => 'pending',
                    'purchase_type' => $cartItem->purchase_type,
                    'is_gift' => $cartItem->is_gift,
                    'recipient_id' => $cartItem->recipient_id,
                    'gift_message' => $cartItem->gift_message,
                ]);

                // Link to order item
                $orderItem->yearbook_subscriptions()->attach($yearbook->id);
            }
        }

        // Mark cart as converted
        $this->status = 'converted_to_order';
        $this->save();

        // Remove cart items
        $this->cartItems()->delete();

        return $order;
    }
} 