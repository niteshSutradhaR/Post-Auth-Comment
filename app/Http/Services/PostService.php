<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use DB,Auth,URL,Paginate;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostService extends Controller
{
	public function getAll($data)
	{
		return Post::with('comments')
			->where(function($query) use ($data){
				if (isset($data['tags']) && $data['tags']!=Null) {
					$tagsArr = explode(" ", $data['tags']);
					foreach ($tagsArr as $tag) {
						$query->where('tags','like','%'.$tag.'%');
					}
				}
			})
			->orderBy('id','desc')->paginate(2);
	}

	public function createPost($data)
	{
		return Post::create($data);
	}

	public function getPostById($id)
	{
		return Post::where('id',$id)->with(['comments','comments.user'])->first();
	}

	public function updatePost($data)
	{
		return Post::where('id',$data['id'])->update(['title' => $data['title'],'description' => $data['description'],'tags'=> $data['tags'] ]);
	}

	public function deletePost($id)
	{
		return Post::where('id',$id)->delete();
	}
}