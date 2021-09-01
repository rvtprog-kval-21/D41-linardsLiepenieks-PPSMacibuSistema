<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function exercise()
    {
        return $this->belongsToMany(Exercise::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function submission()
    {
        return $this->belongsToMany(Submission::class);
    }
}
