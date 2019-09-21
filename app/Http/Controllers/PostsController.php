<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Post;

class PostsController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required',
            'image' => 'required'
        ]);
    
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'image' => $request->image
        ]);

        Session::flash('success', 'Post created');

        return redirect()->route('posts.show', $post->id);

    }

    public function show($id)
    {
        return view('posts.show')->with('post', Post::findOrFail($id));
    }
}