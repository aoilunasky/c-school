<?php

namespace Database\Seeders;

use App\Models\AvailableSchedule;
use App\Models\LessonReservation;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LessonReservationSeeder extends Seeder
{
    public function run()
    {
        // Get all teachers, students, and subjects
        $teachers = Teacher::all();
        $students = Student::all();
        $subjects = Subject::all();

        // Generate lesson reservations for the next 3 months
        foreach ($teachers as $teacher) {
            // Loop through each month of the next three months
            for ($month = 1; $month <= 3; $month++) {
                $currentMonth = Carbon::now()->addMonths($month);
                for ($day = 1; $day <= 28; $day++) { // Assuming reservations are valid within 28 days of each month
                    // Randomly pick a date for the reservation
                    $date = Carbon::create($currentMonth->year, $currentMonth->month, $day);

                    // Randomly generate available slots for that day
                    $availableSchedules = AvailableSchedule::where('teacher_id', $teacher->id)
                        ->where('date', $date->format('Y-m-d'))
                        ->get();

                    if ($availableSchedules->isEmpty()) {
                        continue; // If no available schedule, skip to the next day
                    }

                    // Randomly pick an available schedule for that day
                    foreach ($availableSchedules as $schedule) {
                        // Select random student and subject
                        $student = $students->random();
                        $subject = $subjects->random();

                        // Set lesson start and end time
                        $startTime = Carbon::parse($schedule->start_time);
                        $endTime = $startTime->copy()->addHours(rand(1, 3)); // Set the lesson length to 1-3 hours

                        // Create the lesson reservation
                        $lessonReservation = LessonReservation::create([
                            'teacher_id' => $teacher->id,
                            'student_id' => $student->id,
                            'subject_id' => $subject->id,
                            'start_time' => $startTime->format('H:i:s'),
                            'end_time' => $endTime->format('H:i:s'),
                            'date' => $date->format('Y-m-d'),
                            'lesson_link' => $this->generateLessonLink($teacher), // Generates a lesson link (can be Zoom or Skype)
                            'request' => 'Sample lesson request', // Example of additional details for the lesson
                        ]);

                        // Mark the available schedule as reserved (status = 1)
                        AvailableSchedule::where('id', $schedule->id)
                            ->update(['status' => 1]);

                        // Calculate total hours and create payment based on the lesson reservation
                        $totalHours = $endTime->diffInHours($startTime);
                        $amount = ($teacher->job_type == 1) ? ($totalHours * $teacher->salary_rate) : $teacher->salary_rate;

                        // Create payment based on the lesson reservation
                        Payment::create([
                            'teacher_id' => $teacher->id,
                            'date' => $date->format('Y-m-d'),
                            'total_hour' => $totalHours,
                            'amount' => $amount,
                        ]);
                    }
                }
            }
        }
    }

    // Helper function to generate a lesson link
    private function generateLessonLink($teacher)
    {
        // Generate lesson link based on the teacher's platform
        switch ($teacher->type) {
            case 1:
                return $teacher->zoom_link;
            case 2:
                return $teacher->skype_link;
            default:
                return $teacher->zoom_link; // Default to Zoom link if not specified
        }
    }
}
