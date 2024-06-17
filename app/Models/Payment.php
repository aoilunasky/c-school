<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [ 'teacher_id', 'total_hour', 'amount', 'receipt_url', 'date' ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
