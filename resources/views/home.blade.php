@extends('layouts.app')

@section('content')

  <div class="input-group input-group-sm mb-4">
    <div class="input-group-prepend">
      <span class="input-group-text bg-primary text-white">Search posts</span>
    </div>
    <input type="text" name="search" id="search" class="form-control" placeholder="keyword...">
  </div>

  <ul id="myList">
    @foreach ($posts as $post)
      <li>
        <div class="card mb-3">
          <div class="card-header bg-info">
            <div class="row">
              <div class="col-md-6">
                <h4>{{ $post->title }}</h4> 
                <span>{{ $post->created_at->diffForHumans() }}</span>
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
      </li>
    @endforeach
  </ul>

@push('scripts')
<script charset="utf-8">
$(function(){

  $('#search').on('keyup', function(){
    var value = $(this).val().toLowerCase()
    $('#myList li').filter(function(){
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    })
  })

}) // end of main function
</script>
@endpush
@endsection
