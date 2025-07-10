<?php

namespace App\Models;

use Gloudemans\Shoppingcart\CanBeBought;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model implements Buyable
{
    use SoftDeletes, CanBeBought;

    protected $table = 'products';

    protected $guarded = [
        'id'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    protected function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? null, function (Builder $query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhereHas('category', function (Builder $q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        });

        $query->when($filters['categories'] ?? null, function (Builder $query, $categories) {
            $query->whereHas('category', function (Builder $q) use ($categories) {
                $q->whereIn('name', (array) $categories);
            });
        });

        $query->when($filters['price_min'] ?? null, function (Builder $query, $price_min) {
            $query->where('price', '>=', $price_min);
        });

        $query->when($filters['price_max'] ?? null, function (Builder $query, $price_max) {
            $query->where('price', '<=', $price_max);
        });
    }

    protected function scopeSort(Builder $query, string $sort_options): void
    {
        match ($sort_options) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'created_at_asc' => $query->orderBy('created_at', 'asc'),
            'created_at_desc' => $query->orderBy('created_at', 'desc'),
            'all' => $query->latest(),
        };
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    public function getBuyableWeight($options = null)
    {
        return $this->weight;
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
