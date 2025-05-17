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
        Schema::table('yearbook_subscriptions', function (Blueprint $table) {
            // Add purchase_type column if it doesn't exist
            if (!Schema::hasColumn('yearbook_subscriptions', 'purchase_type')) {
                $table->string('purchase_type')->default('current_subscription')->nullable(); // current_subscription, past_yearbook, gift
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yearbook_subscriptions', function (Blueprint $table) {
            // Remove the column if it exists
            if (Schema::hasColumn('yearbook_subscriptions', 'purchase_type')) {
                $table->dropColumn('purchase_type');
            }
        });
    }
};
