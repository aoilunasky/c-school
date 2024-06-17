<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::insert([
            [
                'name' => 'Beginner',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Intermediate',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Advance',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
