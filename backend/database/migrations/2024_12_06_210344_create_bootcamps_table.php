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
        Schema::create('bootcamps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->text('description');
            $table->text('features'); // Points for features
            $table->decimal('fees', 8, 2); // Bootcamp fees
            $table->text('payment_terms')->nullable(); // Payment terms (optional)
            $table->string('instructor');
            $table->integer('training_duration'); // Duration in weeks or months
            $table->string('main_image'); // Main image
            $table->json('additional_images')->nullable(); // Optional additional images
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bootcamps');
    }
};
