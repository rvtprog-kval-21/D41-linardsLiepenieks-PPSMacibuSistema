<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function exercise()
    {
        return $this->belongsTo(exercise::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
