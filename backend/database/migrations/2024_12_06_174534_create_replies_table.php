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
        Schema::create('replies', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->unsignedBigInteger('contact_us_id'); // Unsigned big integer for the foreign key
            $table->text('reply'); // The admin's reply to the message (change to 'body' here)
            $table->timestamps(); // Timestamps for when the reply was created or updated
    
            // Set up the foreign key constraint
            $table->foreign('contact_us_id')
                  ->references('id')
                  ->on('contact_us')
                  ->onDelete('cascade'); // Deletes the reply if the associated contact_us is deleted
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};