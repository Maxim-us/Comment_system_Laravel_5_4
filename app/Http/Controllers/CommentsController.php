<?php

namespace App\Http\Controllers;

use App\Comment;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
    	$comments = Comment::all();

    	return $comments;
    }
}
