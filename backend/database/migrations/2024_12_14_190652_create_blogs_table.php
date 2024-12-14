<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration {
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignIdFor(User::class, 'user_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('draft'); // 'draft' or 'published'
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('meta_keywords')->nullable(); // stores multiple meta keywords
            $table->json('tags')->nullable(); // stores multiple tags
            $table->json('categories')->nullable(); // stores multiple categories
            $table->json('images')->nullable(); // stores multiple image URLs
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
