<?php

namespace App\Http\Controllers;

use App\Blog;

use Illuminate\Http\Request;

class BlogController extends Controller
{    

    public function index(Blog $blog)
    {
    	$articles = Blog::orderBy('created_at', 'desc')->get();
    	return view('blog.index', compact('articles'));
    }

    public function article(Blog $blog, $article)
    {
    	$article = Blog::find($article);
    	$article->load('comments.user');
        $article->load('comments.votes');

        $count_comments = $article->comments->count();
        
    	return view('blog.article', [
            'article' => $article,
            'count_comments' => $count_comments
        ]);
    }
}