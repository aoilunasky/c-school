<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'file_url',
        'feedback',
        'submitted_date',
    ];
    
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function getFileFullPathAttribute()
    {
        if($this->file_url){
            return Storage::disk('s3')->url($this->file_url);
        }else {
            return '';
        }
    }

    public function getFileNameAttribute()
    {
        if($this->file_url){
            return Str::of($this->file_url)->explode('/')->last();
        }else {
            return '';
        }
    }
}
