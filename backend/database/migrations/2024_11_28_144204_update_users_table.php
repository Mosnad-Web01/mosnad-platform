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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number', 20)->nullable();
            $table->foreignId('role_id')->constrained('roles')->nullable()->after('email');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default(value: 'suspended')->after('role_id');
            $table->softDeletes()->after('status'); // to add deleted_at for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('status');
            $table->dropSoftDeletes();
        });
    }
};
