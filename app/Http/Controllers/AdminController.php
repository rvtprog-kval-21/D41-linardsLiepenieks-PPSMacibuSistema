<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    protected $token = '6e119475ebmsh65d847450b4e390p188601jsn33f056dec39a';
    protected $host = 'judge0.p.rapidapi.com';

    public function index()
    {
        $response = Http::withHeaders([
            'content-type'=> 'application/json',
            'x-rapidapi-key' => $this->token,
            'x-rapidapi-host' => $this->host,
            'useQueryString'=> true,
        ])->get('https://judge0.p.rapidapi.com/languages');



        $tests = $response->headers()['X-RateLimit-Individual-Submissions-Remaining'][0];

        return view('admin_panel/admin_home', compact('tests'));
    }
    public function banner()
    {
        return view('admin_panel/banner');
    }

    public function bannerEdit(Request $request)
    {
        $images = $request->validate([
            'img' => ''
            ]);

        dd($images);
    }
}
