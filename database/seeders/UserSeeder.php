<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected static ?string $password;

    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => static::$password ??= Hash::make('123456'),
                'user_type' => '1',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
            ],
            [
                'name' => 'Teacher',
                'email' => 'teacher@mail.com',
                'password' => static::$password ??= Hash::make('123456'),
                'user_type' => '2',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
            ],
            [
                'name' => 'Student',
                'email' => 'student@mail.com',
                'password' => static::$password ??= Hash::make('123456'),
                'user_type' => '3',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
            ],
            [
                'name' => 'Parent',
                'email' => 'parent@mail.com',
                'password' => static::$password ??= Hash::make('123456'),
                'user_type' => '4',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
            ],
        ]);
    }
}
