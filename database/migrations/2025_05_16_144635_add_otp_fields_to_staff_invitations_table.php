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
            // Add OTP fields for verification
            $table->string('otp_code', 6)->nullable()->after('token');
            $table->timestamp('otp_expires_at')->nullable()->after('otp_code');
            $table->boolean('is_verified')->default(false)->after('otp_expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff_invitations', function (Blueprint $table) {
            // Drop OTP fields
            $table->dropColumn(['otp_code', 'otp_expires_at', 'is_verified']);
        });
    }
};
