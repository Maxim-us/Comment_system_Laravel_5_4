<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Comment;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index( Comment $comment )
    {
    	$comments = Comment::all();

    	return $comments;
    }

	public function store(Request $request)
	{
		$comment = new Comment;
		$comment->user_id = auth()->id();
		$comment->blog_id = $request->blog_id;
		$comment->parent_id = $request->parent_id;
		$comment->comment = $request->comment;

		$comment->save();

		return back();
	}

}
