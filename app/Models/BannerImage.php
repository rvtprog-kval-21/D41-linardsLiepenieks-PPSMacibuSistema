<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    use HasFactory;    protected $guarded = [];


    public function bannerPost()
    {
        return $this->hasOne(User::class);
    }
}
