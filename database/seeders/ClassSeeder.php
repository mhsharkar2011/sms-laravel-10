<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classes')->insert([
            [
                'name' => 'One',
                'created_at' => now(),
            ],
            [
                'name' => 'Two',
                'created_at' => now(),
            ],
            [
                'name' => 'Three',
                'created_at' => now(),
            ],
            [
                'name' => 'Four',
                'created_at' => now(),
            ],
            [
                'name' => 'Five',
                'created_at' => now(),
            ],
        ]);
    }
}
