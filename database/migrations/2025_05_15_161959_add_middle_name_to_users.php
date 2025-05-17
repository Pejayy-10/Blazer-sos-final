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
            // Check if the column doesn't exist before adding it
            if (!Schema::hasColumn('users', 'middle_name')) {
                $table->string('middle_name')->nullable()->after('last_name');
            }
            
            if (!Schema::hasColumn('users', 'suffix')) {
                $table->string('suffix')->nullable()->after('middle_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'middle_name')) {
                $table->dropColumn('middle_name');
            }
            
            if (Schema::hasColumn('users', 'suffix')) {
                $table->dropColumn('suffix');
            }
        });
    }
};
