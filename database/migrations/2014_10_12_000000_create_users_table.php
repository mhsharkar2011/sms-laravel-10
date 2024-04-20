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
            $table->integer('class_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('gender',50)->nullable();
            $table->date('dob')->nullable();
            $table->string('caste',50)->nullable();
            $table->string('religion',50)->nullable();
            $table->string('contact_number',15)->unique()->nullable();
            $table->string('admission_number',50)->unique()->nullable();
            $table->string('roll_number',50)->unique()->nullable();
            $table->date('admission_date')->nullable();
            $table->string('blood_group',10)->nullable();
            $table->string('weight',10)->nullable();
            $table->string('height',10)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('user_type')->nullable();
            $table->string('is_delete')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar',100)->nullable();
            $table->string('created_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
