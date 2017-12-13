<!-- authorization -->
@include('comments._authorization')

<!-- comments -->
{{--<p><span class="badge">{{ $count_comments }}</span> Comments:</p><br>--}}

@foreach($article->comments as $comment)

  @include('comments._comments_list')
  
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