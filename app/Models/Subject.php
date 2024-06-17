<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'status', 'level_id'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teach_subjects');
    }

    public function lesson_reservations()
    {
        return $this->hasMany(LessonReservation::class);
    }
    
    public function assignments()
    {
        return  $this->hasMany(Assignment::class);
    }

    public function lessonFeedbacks()
    {
        return $this->hasMany(LessonFeedback::class);
    }
}
