@extends('layouts.app')

@section('content')

<div class="card">
  <div class="card-header">Edit category</div>
  <div class="card-body">
    <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post">
      @csrf
      @method('put')
      <div class="form-group">
        <input type="text" name="title" class="form-control" value="{{ $category->title }}">
      </div>
      <div class="form-group text-center">
        <button class="btn btn-success btn-lg btn-block" type="submit">Update</button>
      </div>
    </form>
  </div>
</div>

@endsection
