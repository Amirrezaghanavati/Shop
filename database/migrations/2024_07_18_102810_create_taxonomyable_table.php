<?php

use App\Models\Content\Taxonomy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('taxonomyable', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Taxonomy::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->morphs('taxonomyable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxonomyable');
    }
};
