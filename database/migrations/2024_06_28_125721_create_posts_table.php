<?php

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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->text('summary');
            $table->longText('body');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('cover')->nullable();
            $table->text('image')->nullable();
            $table->boolean('commentable')->default(false)->comment('0 => uncommentable, 1 => commentable');
            $table->boolean('status')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
