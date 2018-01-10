<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{	
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function blog()
	{
		return $this->belongsTo(Blog::class);
	}

	// relation votes
	public function votes()
	{
		return $this->hasMany(Vote::class);
	}

	public function votesLike()
	{
		return $this->votes()->where('like', 1);
	}

	public function votesDisLike()
	{
		return $this->votes()->where('dislike', 1);
	}

	public function votesUser()
	{
		return $this->votes()->where('user_id', auth()->id());
	}

	public function replyTo($parent_id){
		$comment_parent_user_id = $this->find($parent_id)->user_id;
		$reply_to_user_name = $this->user->find($comment_parent_user_id)->name;
		return $reply_to_user_name;
	}

}