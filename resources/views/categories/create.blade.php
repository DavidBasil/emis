@extends('layouts.app')

@section('content')
  <div class="card">
    <div class="card-header">Add category</div>
    <div class="card-body">
      <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <div class="form-group">
          <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group text-center">
          <button class="btn btn-success btn-lg btn-block" type="submit">Add</button>
        </div>
      </form>
    </div>
  </div>
@endsection
