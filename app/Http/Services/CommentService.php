<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use DB,Auth,URL,Paginate;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentService extends Controller
{
	public function createComment($data)
	{
		return Comment::create($data);
	}
}