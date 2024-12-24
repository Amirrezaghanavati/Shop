<?php

namespace App\Models\Shop\Product;

use App\Enums\SaleStatus;
use App\Models\Shop\CustomerClub;
use App\Models\Shop\Order\OrderItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use SoftDeletes;

    protected $fillable = ['cover', 'name', 'code', 'price', 'marketable', 'sold', 'frozen', 'in_stock', 'sales_status'];

    protected function casts(): array
    {
        return [
            'sales_status' => SaleStatus::class
        ];
    }

    public function scopeOutOfStock(Builder $builder)
    {
        return $builder->where('in_stock', 0)->orWhere('marketable', 0);
    }

    public function scopeInStockQuery(Builder $builder)
    {
        return $builder->whereNot('in_stock', 0)->orWhereNot('marketable', 0);
    }

    public function outOfStock(): bool
    {
        return $this->in_stock == 0 || $this->marketable == 0;
    }

    // Relationships

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

}
