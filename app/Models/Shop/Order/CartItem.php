<?php

namespace App\Models\Shop\Order;

use App\Models\Shop\Product\Product;
use App\Models\Shop\Product\Sku;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'cover', 'color','sku_id', 'product_object', 'number', 'price', 'total_price'];

    // Relationships

    public function sku(): BelongsTo
    {
        return $this->belongsTo(Sku::class, foreignKey: 'sku_id');
    }

    public function product(): BelongsTo
    {
        return $this->sku->product();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
