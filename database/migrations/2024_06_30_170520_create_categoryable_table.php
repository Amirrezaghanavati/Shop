<?php

use App\Models\Content\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categoryable', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->morphs('categoryable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoryable');
    }
};
