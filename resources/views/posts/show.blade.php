@extends('layouts.app')

@section('content')

  <div class="card"> <!-- post card -->

    <div class="card-body">
      <h3>{{ $post->title }}</h3>
      <img src="{{ $post->image }}" alt="" class="img-fluid">
    </div>

    <ul>
    @foreach ($post->comments as $comment)
      <li>{{ $comment->content }} 
        <span>{{ $comment->user->name }} | <img src="{{ $comment->user->avatar }}" alt="" class="img-fluid" width="40"></span>
        <p>
        @if ($comment->is_liked_by_user())
          <a href="{{ route('comment.unlike', ['id' => $comment->id]) }}" class="btn btn-danger btn-sm">Unlike</a>
        @else 
          <a href="{{ route('comment.like', ['id' => $comment->id]) }}" class="btn btn-success btn-sm">Like</a>
        @endif
          <span class="badge">{{ $comment->likes->count() }}</span>
        </p>
      </li>
    @endforeach
    </ul>

  </div> <!-- end of post card -->

  <div class="card mt-4"> <!-- comment card -->

    <div class="card-body">

      <form action="{{ route('post.comment', ['id' => $post->id]) }}" method="post">
        @csrf
        <div class="form-group">
          <textarea name="content" rows="8" cols="40" id="content" class="form-control" placeholder="Comment..."></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Comment</button>
        </div>
      </form>

    </div>

  </div> <!-- end of comment card -->

@endsection
