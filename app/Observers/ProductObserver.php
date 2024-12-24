<?php

namespace App\Observers;

use App\Models\Shop\Product\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        // $product->sku()->create(['code' => random_int(100000, 999999)]);
    }

    public function updated(Product $product)
    {
        // if($product->sku->discouted_price) {
        //     dd('hi');
        // }

    }
}
