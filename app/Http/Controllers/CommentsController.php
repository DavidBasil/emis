<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Comment;
use App\Like;

class CommentsController extends Controller
{
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $comment = Comment::find($id);

        $comment->content = $request->content;

        $comment->save();

        return 'success';
    }

    public function like($id)
    {
        $comment = Comment::find($id);

        Like::create([
            'comment_id' => $id,
            'user_id' => Auth::id()
        ]);

        Session::flash('success', 'You liked the comment');

        return redirect()->back();
    }

    public function unlike($id)
    {
        $like = Like::where('comment_id', $id)->where('user_id', Auth::id())->first();

        $like->delete();

        Session::flash('success', 'You unliked the reply.');

        return redirect()->back();
    }
}
