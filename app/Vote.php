<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

	protected $table = 'votes';

    public function comment()
	{
		return $this->belongsTo(Comment::class);
	}
}
