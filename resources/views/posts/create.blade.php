@extends('layouts.app')

@section('content')

  <div class="card">
    <div class="card-header">Create a new post</div>
    <div class="card-body">
      <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf  
        <div class="form-group">
          <select name="category_id" id="category_id" size="1" class="form-control">
            <option value="" disabled selected>Select category</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">{{ $category->title }}</option> 
            @endforeach 
          </select>
        </div>
        <div class="form-group">
          <input type="text" name="title" class="form-control" placeholder="Post Title">
        </div>
        <div class="form-group">
          <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success btn-block">Add Post</button>
        </div>
      </form>
    </div>
  </div>

@endsection
