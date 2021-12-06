<?php

namespace App\Http\Controllers;

use App\Http\Services\PostService;
use App\Http\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostService $postService, CommentService $commentService)
    {
        $this->middleware('auth');
        $this->postService = $postService;
        $this->commentService = $commentService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = $this->postService->getAll();
        return view('home',['posts' => $posts]);
    }

    public function createPost(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'user_id' => 'required',
                    'post_date' => 'required',
                    'title' => 'required',
                    'description' => 'required',

                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with(['status' => 1 , 'message' => $validator->errors()]);
            }

            $data = $request->all();
            $data['user_id'] = \Crypt::decrypt($data['user_id']);
            $data['author'] = auth()->user()->name;
            if ($data['tags']) 
            {
                $data['tags'] = $this->filter_tags($data['tags']);
            }
            $createData = $this->postService->createPost($data);

            return redirect()->back()->with(['status' => 1 , 'message' => 'Successfully created post']);

        } catch (\Exception $e) {
            return  redirect()->back()->with(['status' => 1 , 'message' => $e->getMessage()]);
        }
    }

    private function filter_tags($tags)
    {        
        $tagsArr = [];      
        // converting string to array
        $tagsArr = explode(" ", $tags);
        array_filter($tagsArr);
        $tagsArr = array_unique($tagsArr);
        // taking avg length of each tag + space to be 10 characters
        // max avail characters 255
        if (count($tagsArr)>25) {
            $tagsArr = array_slice($tagsArr, 0,25);
        }
        return implode(" ",$tagsArr );
    }

    public function postComment(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $this->commentService->createComment($data);
        return redirect()->back();
    }

    public function editpost(Request $request)
    {
        $post = $this->postService->getPostById($request->id);

        if ($post->tags!=Null) {
            // converting string to array
            $tags = explode(" ", $post->tags);
            array_filter($tags);
            $tags = array_unique($tags);
            $post->tags = implode(" ", $tags);
        }

        return view('posts.edit',['post'=>$post]);
    }

    public function updatePost(Request $request)
    {
        $data = $request->all();
        if ($data['tags']) 
        {
            $data['tags'] = $this->filter_tags($data['tags']);
        }
        $updatePost = $this->postService->updatePost($data);
        if ($updatePost) {
            return redirect()->back()->with(['status' => 1 , 'message' => 'Post has been updated successfully']);
        }
        else
        {
            return redirect()->back()->with(['status' => 1 , 'message' => 'Post could not be updated']);
        }
    }

    public function deletePost(Request $request)
    {   
        $post = $this->postService->getPostById($request->id);
        if (count($post->comments)==0) {
            $deletePost = $this->postService->deletePost($request->id);
        }
        if (isset($deletePost)) {
            return redirect()->back()->with(['status' => 1 , 'message' => 'Post has been deleted successfully']);
        }
        else
        {
            return redirect()->back()->with(['status' => 1 , 'message' => 'Post could not be deleted']);
        }
    }
}
