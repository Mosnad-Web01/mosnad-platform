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
            $table->text('about')->nullable();            
            $table->string('industry')->nullable();
            $table->string('employees')->nullable();
            $table->string('environment')->nullable();
            $table->string('company_website')->nullable();
            $table->string('social_media_link')->nullable();
            $table->string('stage')->nullable();
            $table->text('skills')->nullable(); // Store as JSON if multiple selections
            $table->string('home_workers')->nullable();
            $table->string('training')->nullable();
            $table->string('training_type')->nullable();
            $table->string('hiring')->nullable();
            $table->json('hiring_skills')->nullable();
            $table->json('remote_hiring_preferences')->nullable(); // Remote hiring preferences
            $table->string('yemeni_workers')->nullable();
            $table->string('hiring_fears')->nullable();
            $table->string('precondition')->nullable();
            $table->text('additional_notes')->nullable();
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
              
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('company_forms');
    }
};
