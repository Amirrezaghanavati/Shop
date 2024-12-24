<?php

use App\Models\Shop\Product\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->bigInteger('price')->nullable();
            $table->bigInteger('discounted_price')->nullable();
            $table->bigInteger('discounted_percentage')->nullable();
            $table->text('cover')->nullable();
            $table->integer('marketable')->default(1);
            $table->integer('sold')->default(0);
            $table->integer('frozen')->default(0);
            $table->boolean('in_stock')->default(true);
            $table->tinyInteger('sales_status')->comment('0: available, 1: unavailable, 2: coming-soon, 3: call')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skus');
    }
};
