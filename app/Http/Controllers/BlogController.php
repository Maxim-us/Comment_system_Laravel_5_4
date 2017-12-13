<?php

namespace App\Http\Controllers;

use App\Blog;

use Illuminate\Http\Request;

class BlogController extends Controller
{    

    public function index(Blog $blog)
    {   

    	$articles = Blog::all();
    	return view('blog.index', compact('articles'));

    }

    public function article(Blog $blog, $article)
    {
    	$article = Blog::find($article);
    	$article->load('comments.user');
    	return view('blog.article', compact('article'));
    }

    public function iLoveFood( Comment $comment )
    {
    	$page_identifier = 'iLoveFood';

    	$comments = $comment->orderBy('created_at', 'desc')->get();

    	$count_comments = $comments->count();

    	$user_id = auth()->id();

    	return view('blog.i_love_food', [
    		'page_identifier' => $page_identifier,
    		'comments' => $comments,
    		'count_comments' => $count_comments,
    		'user_id' => $user_id
    	]);
    }

    public function officiallyBlogging()
    {
    	$page_identifier = 'officiallyBlogging';
    	return view('blog.officially_blogging', compact('page_identifier'));
    }
}
