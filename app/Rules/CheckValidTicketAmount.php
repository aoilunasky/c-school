<?php

namespace App\Rules;

use App\Models\AvailableSchedule;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CheckValidTicketAmount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($startTime, $student)
    {
        //
        $this->startTime = AvailableSchedule::find($startTime);
        $this->student = Student::find($student);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $start = Carbon::parse( $this->startTime->start_time);
        $value = Carbon::parse($value)->diffInMinutes($start);
        $i = $value / 15;
        return ($this->student->ticket_amt >= $i);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "You don't have enough ticket to reserve that duration.";
    }
}
