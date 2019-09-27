@extends('layouts.app')

@section('content')

  <div class="card"> <!-- post card -->

    <div class="card-header">
      <h3>{{ $post->title }}</h3>
        <span>
        @auth
          @if ((Auth::id() == $post->user->id) || (Auth::user()->admin))
            <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="btn btn-primary mb-3">edit post</a>
            <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="post">
              @csrf
              @method('delete')
              <button type="submit" class="btn btn-danger">delete post</button>
            </form>
          @endif
        @endauth
        </span>
    </div>

    <div class="card-body">
      <p>Category: 
        <a href="{{ route('categories.show', ['id' => $post->category->id]) }}">{{ $post->category->title }}</a>
      </p>
      <img src="{{ asset($post->image) }}" alt="" class="img-fluid">
    </div>

    <hr>

    <ul>
    @foreach ($post->comments as $comment)
      <li>
        <div>
          <textarea name="content" id="content" class="form-control" readonly>{{ $comment->content }}</textarea>
        </div>
        @if (Auth::id() == $post->user_id)
          <form action="{{ route('comment.destroy', ['id' => $comment->id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger btn-sm">delete comment</button>
         </form> 
        @endif
        {{ $comment->user->name }} 
        @if ((Auth::id() == $comment->user_id))
          <img src="{{ $comment->user->avatar }}" alt="" class="img-fluid mt-3" width="40">
          <input type="hidden" name="" id="commentId" value={{ $comment->id }}>
          <button id="editComment" class="btn btn-warning">edit comment</button> 
        @endif
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

  @auth
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
  @else
    <a href="{{ route('login') }}">Login</a> to post a comment
  @endauth
  
@push('scripts')
<script charset="utf-8">
  $(function(){
    // edit comment
    $('#editComment').on('click', function(){
      if($(this).html() === 'edit comment'){
        $(this).html('save')
        $('#content').attr('readonly', false).css('border', '3px solid pink');
      } else {
        $(this).html('edit comment')
        $('#content').attr('readonly', true).css('border', '1px solid black');
        var content = $('#content').val();
        var commentId = $('#commentId').val();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: 'POST',
          url: '/comments/'+ commentId,
          data: { content: content },
          success: function(data){
            $('#content').parent().prepend('<p class="alert alert-success message">Comment Updated!</p>').hide().fadeIn();
            setTimeout(function(){
            $('.message').fadeOut();
            }, 2000)
          }
        })
      }
    }) // end of edit comment

  }) // end of $(function())
</script>  
@endpush
@endsection
