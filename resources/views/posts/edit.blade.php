@extends('layouts.app')

@section('content')

  <div class="card">
    <div class="card-header">Edit a post</div>
    <div class="card-body">
      <form action="{{ route('posts.update', ['id' => $post->id]) }}" method="post">
        @csrf  
        
        <div class="form-group">
          <input type="text" name="title" class="form-control" placeholder="Post Title" value="{{ $post->title }}">
        </div>
        <div class="form-group">
          <input type="text" name="image" class="form-control" placeholder="Put a link to image" value="{{ $post->image }}">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success btn-block">Update Post</button>
        </div>
      </form>
    </div>
  </div>

@endsection
