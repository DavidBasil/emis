@extends('layouts.app')

@section('content')

  <ul class="list-group">
  @foreach ($posts as $post)
    <li class="list-group-item">
      <a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title }}</a>
    </li>
  @endforeach
  </ul>

@endsection
