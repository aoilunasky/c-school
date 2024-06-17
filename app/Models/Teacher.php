<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;
    const PART_TIME = 1;
    const FULL_TIME = 2;
    protected $fillable = [
        'user_id',
        'gender',
        'dob',
        'job_type',
        'salary_rate',
        'profile_image',
        'country_id',
        'responsibility',
        'address',
        'education',
        'job_history',
        'certificates',
        'strong_points',
        'skype_link',
        'zoom_link',
        'nrc',
        'passport',
        'absence_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teach_subjects');
    }

    public function availableSchedules()
    {
        return $this->hasMany(AvailableSchedule::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function lessonReservations()
    {
        return $this->hasMany(LessonReservation::class);
    }
    public function getJobTypeNameAttribute(){
        if($this->job_type == self::PART_TIME){
            return "Part Time";
        }else if($this->job_type == self::FULL_TIME){
            return "Full Time";
        }
    }
    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return Storage::disk('s3')->url($this->profile_image);
        } else {
            return 'https://c-school.s3.ap-southeast-1.amazonaws.com/local/images/default/default-user-profile.png';
        }
    }

    public function lessonFeedbacks()
    {
        return $this->hasMany(LessonFeedback::class);
    }

    public function getTeachSubjects()
    {
        $subjects = $this->subjects()->pluck('name')->join(', ');
        return $subjects;
    }
}
