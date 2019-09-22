@extends('layouts.app')

@section('content')
  <div class="card">
    <div class="card-body">
      <h3>{{ $post->title }}</h3>
      <img src="{{ $post->image }}" alt="" class="img-fluid">
    </div>
    <ul>
    @foreach ($post->comments as $comment)
      <li>{{ $comment->content }} 
        <span>{{ $comment->user->name }} | <img src="{{ $comment->user->avatar }}" alt="" class="img-fluid" width="40"></span>
      <div>
        LIKE
      </div></li>
    @endforeach
    </ul>
  </div>

  <div class="card mt-4">
    <div class="card-body">
      <form action="{{ route('post.comment', ['id' => $post->id]) }}" method="post">
        @csrf
        <div class="form-group">
          <textarea name="content" rows="8" cols="40" id="content" class="form-control" placeholder="Comment..."></textarea>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Comment</button>
        </div>
        </div>
      </form>
    </div>
  </div>

@endsection
