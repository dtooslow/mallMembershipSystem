<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'shop_id',
        'name',
        'description',
        'price',
        'sale_price',
        'image',
        'is_on_sale',
        'has_discount',
        'points_earned',
    ];

    protected $casts = [
        'price'         => 'decimal:2',
        'sale_price'    => 'decimal:2',
        'is_on_sale'    => 'boolean',
        'has_discount'  => 'boolean',
        'points_earned' => 'integer',
    ];

    protected static function booted()
    {
        static::saved(function ($product) {
            // A product is considered actively on sale if it is visible (is_on_sale) and has an active discount (has_discount)
            $isOnSale = $product->is_on_sale && $product->has_discount;

            if ($isOnSale) {
                $wasOnSale = false;
                if (!$product->wasRecentlyCreated) {
                    $originalIsOnSale = $product->getOriginal('is_on_sale');
                    $originalHasDiscount = $product->getOriginal('has_discount');
                    $wasOnSale = $originalIsOnSale && $originalHasDiscount;
                }

                // If it is on sale now, but was not on sale before
                if (!$wasOnSale) {
                    $product->loadMissing('shop');
                    $shopName = $product->shop->name ?? 'Store';
                    $title = "🔥 Special Sale at {$shopName}!";
                    $priceDisplay = "₱" . number_format($product->sale_price, 2) . " (Discounted from ₱" . number_format($product->price, 2) . ")";
                    $message = "The product \"{$product->name}\" is now on sale for {$priceDisplay}. Check it out in the {$shopName} catalog!";

                    $memberships = \App\Models\Membership::where('status', 'active')->get();
                    foreach ($memberships as $membership) {
                        \App\Models\Notification::create([
                            'user_id' => $membership->user_id,
                            'title'   => $title,
                            'message' => $message,
                            'is_read' => false,
                        ]);
                    }
                }
            }
        });
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /** Returns the effective price (sale price if discount is active, otherwise regular price) */
    public function effectivePrice(): float
    {
        return $this->has_discount ? (float) $this->sale_price : (float) $this->price;
    }
}
