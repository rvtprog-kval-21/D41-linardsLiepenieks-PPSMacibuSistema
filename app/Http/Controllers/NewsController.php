<?php

namespace App\Http\Controllers;
use App\Models\BannerImage;
use App\Models\User;
use App\Models\News;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all()->sortByDesc("created_at");
        $images = BannerImage::all();
        return view('news/news', compact('news', 'images'));
    }

    public function create(User $user)
    {

        $this->authorize('create', Exercise::class);
        return view('news/create');
    }

    public function store()
    {

        $data = request()->validate([
            'nosaukums' => 'required',
            'apraksts' => 'required',

        ]);

        auth()->user()->news()->create([
            'nosaukums'=>$data['nosaukums'],
            'apraksts'=>$data['apraksts'],
        ]);
        return redirect('/news');

    }

    public function delete(\App\Models\News $News)
    {


        $this->authorize('create', Exercise::class);
        $News->delete();
        return redirect('/news');
    }
}
