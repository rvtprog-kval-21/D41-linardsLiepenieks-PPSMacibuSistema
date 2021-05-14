<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function submission()
    {
        return $this->hasMany(Submission::class);
    }
    public function solution()
    {
        return $this->hasMany(Solution::class);
    }

    protected $fillable = ['user_id', 'username'];

}
