@extends('layouts.app')

@section('content')

  <div class="card">
    <div class="card-header">Categories <span class="float-right"><a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">add a category</a></span></div>
    <div class="card-body">
      <table class="table table-hover">
        <tbody>
          @foreach ($categories as $category)
            <tr>
              <td>{{ $category->title }}</td>
              <td>
                <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-sm btn-info text-white">Edit</a>
              </td>
              <td>
                <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
              </td>
            </tr> 
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
