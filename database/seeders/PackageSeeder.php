<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            'title' => 'Free Trial',
            'total_hours' => 1,
            'ticket_amount' => 4,
            'fees' => 0
        ]);
        Package::create([
            'title' => '6 Hour Package',
            'total_hours' => 6,
            'ticket_amount' => 24,
            'fees' => 144000
        ]);
        Package::create([
            'title' => '12 Hour Package',
            'total_hours' => 12,
            'ticket_amount' => 48,
            'fees' => 264000
        ]);
        Package::create([
            'title' => '24 Hour Package',
            'total_hours' => 24,
            'ticket_amount' => 84,
            'fees' => 480000
        ]);
    }
}
