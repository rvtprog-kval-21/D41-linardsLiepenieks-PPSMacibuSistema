<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function  submissionTest()
    {
        return $this->hasMany(SubmissionTest::class);
    }
    public function  solution()
    {
        return $this->hasOne(Solution::class);
    }
}
