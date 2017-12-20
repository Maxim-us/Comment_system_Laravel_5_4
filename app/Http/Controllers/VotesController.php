<?php

namespace App\Http\Controllers;

use App\Vote;

use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function index(Request $request)
    {

    	$voice = new Vote;

    	$voice->user_id = auth()->id();
    	$voice->comment_id = $request->comment_id;
    	$voice->blog_id = $request->blog_id;
    	$voice->like = $request->like;
    	$voice->dislike = $request->dislike;

    	$voice->save();

    }
}
