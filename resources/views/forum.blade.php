@extends('layouts.app')

@section('content')

  @foreach ($posts as $post)
    <div class="card mb-3">
      <div class="card-header bg-info">
        <div class="row">
          <div class="col-md-6">
            <h4>{{ $post->title }}</h4> 
          </div>
          <div class="col-md-6">
            <img src="{{ $post->user->avatar }}" alt="" class="img-fluid rounded-circle w-25 ml-5">
            <span class="float-right">{{ $post->user->name }}</span>
          </div>
        </div>
      </div>
      <div class="card-body">
        <img src="{{ $post->image }}" alt="" class="img-fluid">
        <a href="{{ route('posts.show', ['id' => $post->id]) }}" class="stretched-link btn">view</a>
      </div>
    </div>  
  @endforeach

  <div class="text-center">
    {{ $posts->links() }}
  </div>

@endsection
