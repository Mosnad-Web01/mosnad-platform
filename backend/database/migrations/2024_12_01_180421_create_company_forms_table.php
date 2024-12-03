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
        Schema::create('company_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('industry')->nullable();
            $table->string('employees')->nullable();
            $table->string('stage')->nullable();
            $table->text('skills')->nullable(); // Store as JSON if multiple selections
            $table->string('home_workers')->nullable();
            $table->string('training')->nullable();
            $table->string('hiring');
            $table->json('remote_hiring_preferences')->nullable(); // Remote hiring preferences
            $table->text('additional_notes')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('company_forms');
    }
};
