<!-- authorization -->
@include('comments._authorization')

<!-- comments -->
<p>Comments: <span class="badge">{{ $count_comments }}</span></p><br>

<?php

	$GLOBALS['array_id_HQw4z4kwvrDCj9'] = array();

	function set_children($_comments, $parent_id, $article_id){

		foreach($_comments as $comment):

			if(!in_array($comment->id, $GLOBALS['array_id_HQw4z4kwvrDCj9'])):

				if($comment->parent_id === $parent_id): ?>

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
								<form method="POST" action="/comment" id="form_{{ $comment->id }}">

								  {{ csrf_field() }}
								  
								  <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
								  <input type="hidden" name="blog_id" value="{{ $article_id }}" />
								  <input type="hidden" name="user_id" value="{{ $comment->user_id }}" />

								  <div class="form-group">
								    <textarea class="form-control" rows="3" name="comment" required></textarea>
								  </div>
								  <button type="submit" class="btn btn-success float-right">Answer</button>
								</form>
						    </div>
					    <br>

					    <!-- children -->
					    <div class="mx-children">
					        <?php set_children($_comments, $comment->id, $article_id); ?>
					    </div>
					    <!-- children -->
					  </div>
					</div>

					<?php $GLOBALS['array_id_HQw4z4kwvrDCj9'][] = $comment->id;
				endif;	
			endif;
	  
		endforeach;
	}

	
?>

@foreach($article->comments as $comment)

	@if($comment->parent_id === 0)

		<?php $GLOBALS['array_id_HQw4z4kwvrDCj9'][] = $comment->id; ?>

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

		        @include('comments._answer_form')

		      @endif

		    </div>
		    <br>

		    <!-- children -->
		    <div class="mx-children">
				
				<?php set_children($article->comments, $comment->id, $article->id); ?>

			</div>
		    <!-- children -->
		  </div>
		</div>

	@endif
  
@endforeach

<script>
  $(document).ready(function(){

    // Answer
    $('.mx-answer_link').on('click', function(e){
      e.preventDefault();

      $('.mx-answer').hide();
      $('.mx-answer_link').show();
      $(this).hide();
      $(this).next('.mx-answer').show();
    });
  })
</script>