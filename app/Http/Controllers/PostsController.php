<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Post;
use App\Comment;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2000'
        ]);

        $product_image = $request->image;
        $product_image_new_name = time().$product_image->getClientOriginalName();
        $product_image->move('uploads/posts/', $product_image_new_name);
    
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'image' => 'uploads/posts/'.$product_image_new_name
        ]);

        Session::flash('success', 'Post created');

        return redirect()->route('posts.show', $post->id);

    }

    public function show($id)
    {
        return view('posts.show')->with('post', Post::findOrFail($id));
    }

    public function comment(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $id,
            'content' => $request->content
        ]);

        Session::flash('success', 'Comment added');

        return redirect()->back();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if((Auth::id() == $post->user_id) || (Auth::user()->admin)){
            return view('posts.edit')->with('post', Post::findOrFail($id));
        }
    
        return redirect()->back();

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $post = Post::find($id);

        $post->title = $request->title;

        $post->save();

        Session::flash('success', 'Post updated');

        return redirect()->route('posts.show', ['id' => $post->id]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if(!(Auth::user()->admin) && (Auth::id() !== $post->user_id)){
            return redirect()->back();
        }
        $post->delete();

        Session::flash('success', 'Post deleted');

        return redirect()->route('home');

    }
}
