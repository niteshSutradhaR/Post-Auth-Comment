<?php

namespace App\Http\Controllers;

use App\Http\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostService $postService)
    {
        //$this->middleware('auth');
        $this->postService = $postService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $posts = $this->postService->getAll($data);
        return view('home',['posts' => $posts]);
    }

    public function viewPost(Request $request)
    {
        $post = $this->postService->getPostById($request->id);
        if ($post->tags) {
            // converting string to array
            $tags = explode(" ", $post->tags);
            array_filter($tags, function($tag){
                return $tag != "";
            });
            $post->tags = $tags;
        }
        return view('posts.view',['post' => $post]);
    }
}
