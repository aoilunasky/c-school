<?php

namespace Database\Seeders;

use App\Models\AvailableSchedule;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AvailableScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = Teacher::all();
        foreach($teachers as $teacher){
            $this->addData($teacher);
        }
    }

    public function addData($teacher)
    {
        $endDate = Carbon::now()->addMonth();
        $start = Carbon::now()->addDay(1);
        while($start->lessThanOrEqualTo($endDate)){
            $startHour = rand(9,12);
            $hours = rand(1,17-$startHour);
            $date = $start->toDateString();
            $startTime = Carbon::parse($startHour.':00');
            while($startTime->lessThanOrEqualTo(Carbon::parse($startHour.':00')->addHours($hours))){
                $endTime= $startTime->format('H:i:s');
                AvailableSchedule::create([
                    'teacher_id' => $teacher->id,
                    'start_time' => $startTime->format('H:i:s'),
                    'date' => $date,
                    'end_time' => Carbon::parse($endTime)->addMinutes(15)->format('H:i:s'),
                    'status' => 0,
                ]);
                $startTime->addMinutes(15);
            }
            $start->addDay(1);
        }
    }
}
