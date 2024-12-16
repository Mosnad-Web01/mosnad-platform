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
        Schema::create('youth_forms', function (Blueprint $table) {
            $table->id();
            $table->string('gender')->nullable(); // Gender
            $table->boolean('is_it_graduate')->nullable(); // IT graduate status
            $table->string('job_interest')->nullable(); // Job interest
            $table->text('motivation')->nullable(); // Motivation for learning
            $table->text('career_goals')->nullable(); // Career goals
            $table->text('project_ideas')->nullable(); // Project ideas
            $table->boolean('has_workshops')->nullable(); // Attended workshops
            $table->text('workshop_clarify')->nullable(); // Workshop clarifications
            $table->boolean('has_coding_experience')->nullable(); // Coding experience
            $table->text('coding_clarify')->nullable(); // Coding experience clarifications
            $table->boolean('knows_other_languages')->nullable(); // Knows other programming languages
            $table->string('languages')->nullable(); // Programming languages
            $table->text('creative_problem_solving')->nullable(); // Creative problem solving
            $table->text('website_vs_webapp')->nullable(); // Website vs WebApp explanation
            $table->text('usability_steps')->nullable(); // Steps to ensure usability
            $table->text('additional_info')->nullable(); // Additional information
            $table->string('document')->nullable(); // File upload path
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youth_forms');
    }
};
