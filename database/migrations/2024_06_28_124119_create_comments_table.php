<?php

use App\Models\Content\Comment;
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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(Comment::class, 'parent_id')->nullable()->constrained('comments')->cascadeOnDelete()->nullOnDelete();
            $table->morphs('commentable');
            $table->text('body');
            $table->boolean('seen')->default(false)->comment('0 => unseen, 1 => seen');
            $table->enum('approved', ['pending', 'approved', 'rejected'])->default('pending');
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
        Schema::dropIfExists('comments');
    }
};
