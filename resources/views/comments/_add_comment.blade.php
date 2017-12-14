<h4>Leave a Comment:</h4>
<form method="POST" action="/comment">

	{{ csrf_field() }}

	<input type="hidden" name="parent_id" value="0" />
	<input type="hidden" name="blog_id" value="{{ $article->id }}" />

	<div class="form-group">
	  <textarea class="form-control" rows="3" name="comment" required></textarea>
	</div>
	<button type="submit" class="btn btn-success float-right">Submit</button>
	
</form>
<br><br>