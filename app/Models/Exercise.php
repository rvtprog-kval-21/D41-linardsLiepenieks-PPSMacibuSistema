<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
    public function submission()
    {
        return $this->hasMany(Submission::class);
    }

    public function solution()
    {
        return $this->hasMany(Solution::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected $guarded = [];
}
