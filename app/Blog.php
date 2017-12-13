<?php

namespace App;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	protected $table = 'blog';

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
}
