<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'date',
        'start_time',
        'end_time',
        'status'// 0 => Open, 1=> booked
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
