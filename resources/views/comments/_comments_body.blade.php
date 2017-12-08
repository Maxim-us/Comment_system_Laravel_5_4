<!-- authorization -->

@include('comments._authorization')

<!-- comments -->
<p><span class="badge">{{ $count_comments }}</span> Comments:</p><br>

@foreach($comments as $comment)
  <div class="row mx-comment" id="{{ $comment->id }}" data-parent_id="{{ $comment->parent_id }}">
    <div class="col-sm-2 text-center">
      <img src="https://78.media.tumblr.com/84365fe19039b5fd917d6d449ca86290/tumblr_op4lb5DPRe1qg6rkio1_500.jpg" class="img-circle" height="65" width="65" alt="Avatar">
    </div>
    <div class="col-xs-10">
      <h4>{{ $comment->user->name }} <small>{{ $comment->created_at }}</small></h4>
      <p>{{ $comment->comment }}</p>
      <br>

     <a href="#" class="float-right mx-answer_link">Answer</a>

      <div class="mx-answer">

        @if(Auth::guest())
          <h5>Sing in to answer</h5>
        @else
        
          <form method="POST" action="/comment" id="form_{{ $comment->id }}">

            {{ csrf_field() }}
            
            <input type="hidden" name="page_identifier" value="{{ $page_identifier }}" />
            <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            <input type="hidden" name="user_id" value="{{ $user_id }}" />

            <div class="form-group">
              <textarea class="form-control" rows="3" name="comment" required></textarea>
            </div>
            <button type="submit" class="btn btn-success float-right">Answer</button>
          </form>

        @endif

      </div>
      <br>

      <!-- children -->
      <div class="mx-children"></div>
      <!-- children -->
    </div>
  </div>
@endforeach

@include('comments._scripts')