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
    	return view('blog.i_love_food');
    }

    public function officiallyBlogging()
    {
    	return view('blog.officially_blogging');
    }
}
