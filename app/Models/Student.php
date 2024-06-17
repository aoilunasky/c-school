<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    const LESSON_ONLINE = 1;
    const LESSON_SCHOOL = 2;

    protected $fillable = [ 'user_id', 'gender', 'age', 'lesson_type', 'purpose', 'ticket_amt' ];

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class,'package_histories')->withPivot('id','date','status','ticket_amt','fees','type','card_name','card_number');
    }

    public function lessonReservations()
    {
        return $this->hasMany(LessonReservation::class);
    }

    public function getLessonTypeNameAttribute(){
        if($this->lesson_type == self::LESSON_ONLINE){
            return "Online";
        }else if($this->lesson_type == self::LESSON_SCHOOL){
            return "School";
        }
    }

    public function increaseTicketAmt(int $value){
        $this->ticket_amt += $value;
    }

    public function decreaseTicketAmt(int $value)
    {
        if($value < $this->ticket_amt){
            $this->ticket_amt -= $value;
        }
    }

    public function lessonFeedbacks()
    {
        return $this->hasMany(LessonFeedback::class);
    }
}
