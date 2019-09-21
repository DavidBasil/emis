<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class ForumsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);

        return view('forum')->with('posts', $posts);
    }
        
}
