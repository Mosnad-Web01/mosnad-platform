<?php

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
        Schema::create('activities', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Title of the activity
            $table->text('description'); // Description of the activity
            $table->timestamp('activity_date'); // The date of the activity
            $table->string('location')->nullable(); // Location of the activity
            $table->json('images')->nullable(); // Store image paths in JSON format
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
