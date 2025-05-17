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
        if (!Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
                $table->foreignId('yearbook_platform_id')->constrained('yearbook_platforms');
                $table->integer('quantity')->default(1);
                $table->decimal('price', 10, 2);
                $table->boolean('is_gift')->default(false);
                $table->foreignId('recipient_id')->nullable()->constrained('users');
                $table->text('gift_message')->nullable();
                $table->string('purchase_type')->default('current_yearbook'); // current_yearbook, past_yearbook
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
