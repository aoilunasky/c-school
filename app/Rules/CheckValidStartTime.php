<?php

namespace App\Rules;

use App\Models\AvailableSchedule;
use Illuminate\Contracts\Validation\Rule;

class CheckValidStartTime implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $startTimeSlot;

    public function __construct()
    {
        //
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
       $this->startTimeSlot = AvailableSchedule::find($value);
       return $this->startTimeSlot->status == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Teacher is not available at {$this->startTimeSlot->start_time}";
    }
}
