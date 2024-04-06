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
                'first_name' => 'Monir',
                'last_name' => 'Hossain',
                'email' => 'admin@mail.com',
                'password' => static::$password ??= Hash::make('123456'),
                'user_type' => '1',
                'status' => '0',
                'gender' => 'Male',
                'email_verified_at' => now(),
                'remember_token' => Str::random(34),
                'created_at' => now(),
            ],
            [
                'first_name' => 'Teacher',
                'last_name' => '',
                'email' => 'teacher@mail.com',
                'password' => static::$password ??= Hash::make('123456'),
                'user_type' => '2',
                'status' => '0',
                'gender' => 'Male',
                'email_verified_at' => now(),
                'remember_token' => Str::random(34),
                'created_at' => now(),
            ],
            [
                'first_name' => 'Student',
                'last_name' => '',
                'email' => 'student@mail.com',
                'password' => static::$password ??= Hash::make('123456'),
                'user_type' => '3',
                'status' => '0',
                'gender' => 'Male',
                'email_verified_at' => now(),
                'remember_token' => Str::random(34),
                'created_at' => now(),
            ],
            [
                'first_name' => 'Parent',
                'last_name' => '',
                'email' => 'parent@mail.com',
                'password' => static::$password ??= Hash::make('123456'),
                'user_type' => '4',
                'status' => '0',
                'gender' => 'Male',
                'email_verified_at' => now(),
                'remember_token' => Str::random(34),
                'created_at' => now(),
            ],
        ]);
    }
}
