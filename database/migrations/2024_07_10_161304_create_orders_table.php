<?php

use App\Models\Location\Address;
use App\Models\Shop\Gateway;
use App\Models\Shop\Order\Payment;
use App\Models\Shop\Order\Transaction;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Address::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Payment::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Transaction::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Gateway::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->longText('payment_object')->nullable();
            $table->bigInteger('price')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('status')->comment('0: pending, 1: confirmed, 2: cancelled, 3: expired, 4: returned')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
