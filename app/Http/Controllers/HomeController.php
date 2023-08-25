<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('home');
    }

    public function allPosts()
    {

        $posts = Post::where('user_id', Auth::user()->id)->get();
        return view('posts.all-post', compact('posts'));
    }
}
