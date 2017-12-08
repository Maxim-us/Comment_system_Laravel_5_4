<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Comment;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index( Comment $comment )
    {
    	// $comment = Comment::with('users.user')->get();
    	//$comment->load('user.comment');
    	$comments = Comment::all();
    	//$user = $comment->user;

    	return $comments;
    }

	public function store(Request $request)
	{
		// DB::table('comments')->create( $request->all() );
		$comment = new Comment;
		$comment->user_id = $request->user_id;
		$comment->page_identifier = $request->page_identifier;
		$comment->parent_id = $request->parent_id;
		$comment->comment = $request->comment;

		$comment->save();

		return back();
	}

}
