<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('driver');
            $table->text('merchant_id')->nullable();
            $table->string('callback_url')->nullable();
            $table->text('description')->nullable();
            $table->string('mode')->default('normal')->comment('normal|sandbox|zaringate|direct,...');
            $table->string('currency')->default('T')->comment('R|T (Rial, Toman)');
            $table->text('image')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateways');
    }
};
