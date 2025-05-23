<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            // Foreign key to colleges table
            $table->foreignId('college_id')->constrained()->onDelete('cascade');
            $table->string('name'); // e.g., "BS Information Technology"
            $table->string('abbreviation')->nullable(); // e.g., "BSIT"
            // Add unique constraint for name within a college
            $table->unique(['college_id', 'name']);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('courses'); }
};