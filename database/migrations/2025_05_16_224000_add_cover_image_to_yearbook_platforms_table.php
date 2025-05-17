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
        Schema::table('yearbook_platforms', function (Blueprint $table) {
            $table->string('cover_image')->nullable()->after('background_image_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yearbook_platforms', function (Blueprint $table) {
            if (Schema::hasColumn('yearbook_platforms', 'cover_image')) {
                $table->dropColumn('cover_image');
            }
        });
    }
};
