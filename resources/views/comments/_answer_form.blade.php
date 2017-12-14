<form method="POST" action="/comment" id="form_{{ $comment->id }}">

  {{ csrf_field() }}
  
  <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
  <input type="hidden" name="blog_id" value="{{ $article->id }}" />
  <input type="hidden" name="user_id" value="{{ $comment->user_id }}" />

  <div class="form-group">
    <textarea class="form-control" rows="3" name="comment" required></textarea>
  </div>
  <button type="submit" class="btn btn-success float-right">Answer</button>
</form>