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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // ✅ ADDED: Foreign key to directories table
            $table->foreignId('directory_id')->constrained()->onDelete('cascade');
            // ✅ ADDED: Foreign key to sections table
            $table->foreignId('section_id')->constrained()->onDelete('cascade');
            // ✅ ADDED: Student name field
            $table->string('name');
            // ✅ ADDED: Student email field
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};