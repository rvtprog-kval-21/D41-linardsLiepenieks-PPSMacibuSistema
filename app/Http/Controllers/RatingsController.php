<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function index()
    {
        $rating = Profile::all()->sortByDesc("score");
        return view('rating/rating', compact('rating', 'rating'));
    }
}
