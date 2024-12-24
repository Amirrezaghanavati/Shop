<?php

use App\Models\Shop\Product\Product;
use App\Models\Shop\Product\Sku;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Sku::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->longText('product_object');
            $table->text('cover')->nullable();
            $table->string('color')->nullable();
            $table->integer('number')->default(1);
            $table->bigInteger('price')->default(0);
            $table->bigInteger('total_price')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
