<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $filable = ['comment', 'user_id', 'page_identifier', 'parent_id'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
