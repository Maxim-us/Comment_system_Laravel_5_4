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