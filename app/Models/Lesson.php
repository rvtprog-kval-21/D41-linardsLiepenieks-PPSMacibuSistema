<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function courses()
    {
        return $this->belongsTo(Course::class);
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class);
    }
}
