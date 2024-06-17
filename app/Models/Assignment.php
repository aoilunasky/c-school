<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    // 1 for given 2 for answered 3 for overdue
    const GIVEN = 1;
    const ANSWERED = 2;
    const OVERDUE = 3;

    protected $fillable = [
        'title',
        'teacher_id',
        'student_id',
        'subject_id',
        'question_url',
        'deadline',
        'status'
    ];

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getStatusTextAttribute()
    {
        switch($this->status){
            case self::GIVEN : return "given";break;
            case self::ANSWERED : return "answered";break;
            case self::OVERDUE : return "overdue";break;
            default: return "-";break;
        }
    }

    public function getQuestionFullPathAttribute()
    {
        if($this->question_url){
            return Storage::disk('s3')->url($this->question_url);
        }else {
            return '';
        }
    }

    public function getFileNameAttribute()
    {
        if($this->question_url){
            return Str::of($this->question_url)->explode('/')->last();
        }else {
            return '';
        }
    }
}
