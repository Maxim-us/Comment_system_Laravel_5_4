<h4>Leave a Comment:</h4>
<form method="POST" action="/comment">

	{{ csrf_field() }}

	<input type="hidden" name="page_identifier" value="{{ $page_identifier }}" />
	<input type="hidden" name="parent_id" value="" />
	<input type="hidden" name="user_id" value="{{ $user_id }}" />

	<div class="form-group">
	  <textarea class="form-control" rows="3" name="comment" required></textarea>
	</div>
	<button type="submit" class="btn btn-success float-right">Submit</button>
	
</form>
<br><br>