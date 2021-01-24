<?php

namespace App\Http\Controllers;

use App\Models\BannerImage;
use App\Models\Exercise;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder\Class_;
use function GuzzleHttp\json_decode;

class AdminController extends Controller
{

    protected $token = '6e119475ebmsh65d847450b4e390p188601jsn33f056dec39a';
    protected $host = 'judge0-ce.p.rapidapi.com';

    public function index()
    {
        $response = Http::withHeaders([
            'content-type'=> 'application/json',
            'x-rapidapi-key' => $this->token,
            'x-rapidapi-host' => $this->host,
            'useQueryString'=> true,
        ])->get('https://judge0-ce.p.rapidapi.com/about');


        //dd($response);
        $tests = $response->headers()['X-RateLimit-Submissions-Remaining'][0];

        return view('admin_panel/admin_home', compact('tests'));
    }
    public function banner()
    {
        return view('admin_panel/banner');
    }

    public function bannerEdit(Request $request)
    {
        //Validate inputs
        $images = $request->validate([
            'photo' => 'required|array'
            ]);

        //Store each image
        foreach ($images['photo'] as $photo){
        $newPath = $photo->store('bannerImages', ['disk' => 'public']);

            auth()->user()->bannerPost()->create([
                'file_path'=>$newPath,
            ]);
        }

        redirect('/news');



    }
}
