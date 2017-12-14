<!-- authorization -->
@include('comments._authorization')

<!-- comments -->
{{--<p><span class="badge">{{ $count_comments }}</span> Comments:</p><br>--}}

<?php

	$GLOBALS['array_id'] = array();

	function set_children($_comments, $parent_id){

		foreach($_comments as $comment):

			if(!in_array($comment->id, $GLOBALS['array_id'])){				

				if($comment->parent_id === $parent_id){
					$parent_id = $comment->id;
					?><div style="padding-left: 20px; border: 1px solid #ddd;">
						<p>
							<span>ID: {{ $comment->id }}</span><br>
							<span>Parent ID: {{ $comment->parent_id }}</span><br>
							{{ $comment->comment }}
						</p>
						<div class="children">
							<?php set_children($_comments, $parent_id); ?>
						</div>
					</div><?php

					$GLOBALS['array_id'][] = $comment->id;
				}	
			}					
	  
		endforeach;
	}

	
?>

@foreach($article->comments as $comment)

	@if($comment->parent_id === 0)

		<?php $GLOBALS['array_id'][] = $comment->id; ?>

		<div style="padding-left: 20px; border: 1px solid #ddd;">
			<p>
				<span>ID: {{ $comment->id }}</span><br>
				<span>Parent ID: {{ $comment->parent_id }}</span><br>
				{{ $comment->comment }}
			</p>
			<div class="children">
				<?php set_children($article->comments, $comment->id); ?>
			</div>
		</div>
	@endif
  
@endforeach

<?php var_dump($GLOBALS['array_id']); ?>

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