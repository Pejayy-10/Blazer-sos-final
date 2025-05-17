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
        Schema::table('staff_invitations', function (Blueprint $table) {
            // Add role_name_id column after role_name
            $table->foreignId('role_name_id')->nullable()->after('role_name');
            
            // Add accepted_at column to track when invitation was accepted
            $table->timestamp('accepted_at')->nullable()->after('registered_at');
            
            // Add foreign key relationship
            $table->foreign('role_name_id')->references('id')->on('role_names')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_invitations', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['role_name_id']);
            
            // Drop columns
            $table->dropColumn(['role_name_id', 'accepted_at']);
        });
    }
};
