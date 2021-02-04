<?php

namespace App\Http\Controllers;

use App\Models\BannerImage;
use App\Models\Exercise;
use App\Models\Tag;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder\Class_;
use function GuzzleHttp\json_decode;

class AdminController extends Controller
{

    public function __construct()
    {
        //$this->authorize('create', Exercise::class);
    }

    protected $token = '6e119475ebmsh65d847450b4e390p188601jsn33f056dec39a';
    protected $host = 'judge0-ce.p.rapidapi.com';

    public function index()
    {
        $this->authorize('create', Exercise::class);

        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'x-rapidapi-key' => $this->token,
            'x-rapidapi-host' => $this->host,
            'useQueryString' => true,
        ])->get('https://judge0-ce.p.rapidapi.com/about');

        $tests = $response->headers()['X-RateLimit-Submissions-Remaining'][0];

        return view('admin_panel/admin_home', compact('tests'));
    }

    public function banner(BannerImage $bannerImage)
    {
        $this->authorize('create', Exercise::class);
        $bannerImage = BannerImage::All();
        return view('admin_panel/banner', compact('bannerImage'));
    }

    public function bannerEdit(Request $request)
    {
        $this->authorize('create', Exercise::class);

        //Validate inputs
        $images = $request->validate([
            'photo' => '',
            'delete' => ''
        ]);

        //Store each image
        if ($images['photo'] ?? null) {
            foreach ($images['photo'] as $photo) {
                $newPath = $photo->store('bannerImages', ['disk' => 'public']);

                auth()->user()->bannerPost()->create([
                    'file_path' => $newPath,
                ]);
            }
        }

        //check for images to be deleted
        if ($images['delete'] ?? null) {
            foreach ($images['delete'] as $del) {
                BannerImage::Where('file_path', $del)->delete();
                Storage::disk('public')->delete($del);
            }
        }

        redirect('/news');
    }

    public function tags()
    {
        $oldTags = Tag::All();
        return view('admin_panel/tags', compact('oldTags'));
    }

    public function tagEdit(Request $request, Response $response)
    {

        $newTags = request()->validate([

            'newTags' => '',
            'delete' => '',
            'update' => '',

        ]);


        foreach ($newTags['newTags'] as $newTag)
        {
            if (Tag::Where('name', $newTag['name'])->first() == null) {
                $t = new Tag;
                $t->color = $newTag['color'];
                $t->name = $newTag['name'];
                $t->desc = $newTag['desc'];
                $t->save();
            }
        }

        foreach ($newTags['delete'] as $delTag)
        {
            $target = Tag::Where('name', $delTag['name'])->first();
            $target->exercise()->detach();
            $target->delete();

        }
        foreach ($newTags['update'] as $upTag)
        {
            $t = Tag::Where('name', $upTag['name'])->first();
            $t->color = $upTag['color'];
            $t->name = $upTag['name'];
            $t->desc = $upTag['desc'];
            $t->save();

        }

    }
}
