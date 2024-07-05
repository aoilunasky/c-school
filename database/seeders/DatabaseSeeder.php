<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            CountrySeeder::class,
            LevelSeeder::class,
            PackageSeeder::class,
        ]);
        Subject::factory(4)->create();
        Teacher::factory(20)->create();
        Student::factory(20)->create();
        $subjects = Subject::all();
        Teacher::all()->each(function ($teacher) use ($subjects) {
            $teacher->subjects()->attach(
                $subjects->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
        $package = Package::find(1);
        Student::all()->each(function ($studnet) use ($package) {
            $studnet->packages()->attach($package->id,
                [
                    'date' => now(),
                    'status' => 1,
                    'ticket_amt' => $package->ticket_amount,
                    'fees' => $package->fees,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            $studnet->ticket_amt = $package->ticket_amount;
            $studnet->save();
        });
        $this->call(AvailableScheduleSeeder::class);
    }
}
