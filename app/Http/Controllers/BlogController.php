<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{    

    public function index()
    {
    	return view('blog.index');
    }

    public function iLoveFood()
    {
    	$page_identifier = 'iLoveFood';
    	return view('blog.i_love_food', compact('page_identifier'));
    }

    public function officiallyBlogging()
    {
    	$page_identifier = 'officiallyBlogging';
    	return view('blog.officially_blogging', compact('page_identifier'));
    }
}
