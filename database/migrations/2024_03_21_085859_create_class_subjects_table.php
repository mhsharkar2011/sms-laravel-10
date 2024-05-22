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
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('is_deleted')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->unique(['class_id', 'subject_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_subjects');
    }
};
