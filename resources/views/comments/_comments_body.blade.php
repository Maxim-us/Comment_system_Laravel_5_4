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
					    <h4>
					    	<span>{{ $comment->user->name }} <small>{{ $comment->created_at }}</small></span>
					    </h4>
					    <p>{{ $comment->comment }}</p>

					    @if(!Auth::guest())

						    <div class="bg-secondary mx-wrap_votes" data-user_id="{{ $comment->user->id }}" data-comment_id="{{ $comment->id }}" data-blog_id="{{ $article_id }}" <?php if($comment->votesUser->count() > 0){ echo 'data-is_vote="true"'; } ?>>

						    	@if($comment->votesUser->count() > 0)
									<span>You already voted </span>
								@endif

								<div class="like-button_wrap">									
									<button class="like-button btn-like"><i class="fa fa-thumbs-up text-success" aria-hidden="true"></i></button> - 
									<span class="count_votes like">{{ $comment->votesLike->count() }}</span>
								</div>
								<div class="like-button_wrap">
									<button class="like-button btn-dislike"><i class="fa fa-thumbs-down text-muted" aria-hidden="true"></i></button> - 
									<span class="count_votes dislike">{{ $comment->votesDisLike->count() }}</span>
								</div>
						    </div>

					    @endif
					    <br>

						<a href="#" class="float-right mx-answer_link">Answer</a>
						<div class="mx-answer">

							@if(Auth::guest())

								<h5>Sing in to answer</h5>

							@else
							    
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
							    
							@endif
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

		    @if(!Auth::guest())

			    <div class="bg-secondary mx-wrap_votes" data-user_id="{{ $comment->user->id }}" data-comment_id="{{ $comment->id }}" data-blog_id="{{ $article->id }}" <?php if($comment->votesUser->count() > 0){ echo 'data-is_vote="true"'; } ?>>

			    	@if($comment->votesUser->count() > 0)
						<span>You already voted </span>
					@endif

					<div class="like-button_wrap">						
						<button class="like-button btn-like"><i class="fa fa-thumbs-up text-success" aria-hidden="true"></i></button> - 
						<span class="count_votes like">{{ $comment->votesLike->count() }}</span>
					</div>
					<div class="like-button_wrap">
						<button class="like-button btn-dislike"><i class="fa fa-thumbs-down text-muted" aria-hidden="true"></i></button> - 
						<span class="count_votes dislike">{{ $comment->votesDisLike->count() }}</span>
					</div>
			    </div>
			@endif
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

    // Votes
    $('.like-button').on('click', function(){

    	var isVoted = $(this).parent().parent().attr('data-is_vote');    	
    	
    	if(!isVoted){

	    	var like = likeOrDislike($(this)).like;
	    	var dislike = likeOrDislike($(this)).dislike;
    		
    		var user_id = $(this).parent().parent().attr('data-user_id');
	    	var blog_id = $(this).parent().parent().attr('data-blog_id');
	    	var comment_id = $(this).parent().parent().attr('data-comment_id');

	    	var dataQuery = '_token={{ csrf_token() }}&comment_id='+comment_id+'&blog_id='+blog_id+'&like='+like+'&dislike='+dislike;

	    	// query for DB
	    	ajaxQuery($(this), dataQuery, comment_id, like, dislike);

    	}
    	
    });

    /* help-functions */
    function likeOrDislike(_this){

    	var like = 0;
	   	var dislike = 0;

    	if(_this.hasClass('btn-like')){
    		like = 1;
    		dislike = 0;
    	} else{
    		like = 0;
    		dislike = 1;
    	}

    	return {
    		like: like,
    		dislike: dislike
    	};
    }

    // ajax query
    function ajaxQuery(_this, _data, _comment_id, _like, _dislike ){    	

    	$.ajax( {
	    	type: 'POST',
	    	url: '/vote',
	    	data: _data,
	    	success: function(data){

	    		$('.mx-wrap_votes').each(function(){

	    			var dataCommentId = $(this).attr('data-comment_id');
	    			dataCommentId = parseInt(dataCommentId);
	    			comment_id = parseInt(_comment_id);

	    			if(dataCommentId === comment_id){
	    				var voteLike = $(this).find('.like').text();

	    				voteLike = parseInt(voteLike)+_like;
	    				var voteDisLike = $(this).find('.dislike').text();

	    				voteDisLike = parseInt(voteDisLike)+_dislike;

	    				$(this).find('.like').text(voteLike);
	    				$(this).find('.dislike').text(voteDisLike);

	    				// Voting is closed
	    				$(this).prepend('<span>You already voted </span>');
	    				$(this).find('.like-button').removeClass('like-button');
	    				$(this).attr('data-is_vote', 'true');

	    			}

	    		});
	    		// show logs
	    		//console.log(data);
	    		
	    	}
	    } );
    }

    
  });
</script>