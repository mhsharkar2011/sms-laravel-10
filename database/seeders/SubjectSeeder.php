<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert([
            [
                'name' => 'Bangla',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'English',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Math',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Science',
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Islamic',
                'created_by' => 1,
                'created_at' => now(),
            ],
        ]);
    }
}
