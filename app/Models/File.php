<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'file_url', 'subject_id' ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_files');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class)->withTrashed();
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
