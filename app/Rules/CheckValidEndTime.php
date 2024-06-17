<?php

namespace App\Rules;

use App\Models\AvailableSchedule;
use Illuminate\Contracts\Validation\Rule;

class CheckValidEndTime implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($startTime)
    {
        $this->startTime = AvailableSchedule::find($startTime);

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
        $availableSlots = AvailableSchedule::where('teacher_id',$this->startTime->teacher_id)->where('date',$this->startTime->date)->where('start_time','>=',$this->startTime->start_time)->where('end_time','<=',$value)->get()->filter(function ($data, $key) {
            return $data->status == 1;
        });
        return $availableSlots->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Teacher is not available that time.";
    }
}
