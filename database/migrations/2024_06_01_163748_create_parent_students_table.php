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
        Schema::create('parent_students', function (Blueprint $table) {
            $table->id();
            $table->string('parent_id')->nullable();
            $table->string('student_id')->nullable();
            $table->string('created_by')->nullable();
            $table->integer('is_deleted')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->unique(['parent_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_students');
    }
};
