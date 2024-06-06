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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('class_id')->unique()->nullable();
            $table->string('teacher_id')->unique()->nullable();
            $table->string('student_id')->unique()->nullable();
            $table->string('parent_id')->unique()->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('dob_id')->unique()->nullable();
            $table->string('parent_nid')->unique()->nullable();
            $table->string('teacher_nid')->unique()->nullable();
            $table->string('gender',50)->nullable();
            $table->date('dob')->nullable();
            $table->string('religion',50)->nullable();
            $table->string('contact_number',15)->unique()->nullable();
            $table->date('admission_date')->nullable();
            $table->string('admission_number',50)->unique()->nullable();
            $table->string('roll_number',50)->unique()->nullable();
            $table->string('blood_group',10)->nullable();
            $table->string('weight',10)->nullable();
            $table->string('height',10)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('user_type')->nullable();
            $table->string('is_deleted')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar',100)->nullable();
            $table->string('created_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unique(['class_id', 'id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
