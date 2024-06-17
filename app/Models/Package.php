<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'total_hours', 'ticket_amount', 'fees'];

    public function students()
    {
        return $this->belongsToMany(Student::class, PackageHistory::class)->withPivot([
            'date', 'status', 'ticket_amt', 'fees'
        ]);
    }

    public function lessonReservations()
    {
        return $this->hasMany(LessonReservation::class);
    }
}
