<?php

namespace App\Models\Shop\Order;

use App\Models\Shop\Product\Product;
use App\Models\Shop\Product\QrCode;
use App\Models\Shop\Product\Sku;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'cover', 'color', 'sku_id', 'product_object', 'number', 'price', 'total_price', 'deleted_at'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function sku(): BelongsTo
    {
        return $this->belongsTo(Sku::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
