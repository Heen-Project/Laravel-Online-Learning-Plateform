<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
	use SoftDeletes;
	protected $table = 'comments';
	protected $fillable = ['userId', 'lessonId', 'articleId', 'discussionId', 'content'];
	// protected $hidden = [''];

	public function creator()
	{
		return $this->belongsTo('App\User', 'userId', 'id');
	}

	public function lesson()
	{
		return $this->belongsTo('App\Lesson', 'lessonId', 'id');
	}

	public function article()
	{
		return $this->belongsTo('App\Article', 'articleId', 'id');
	}

	public function discussion()
	{
		return $this->belongsTo('App\Discussion', 'discussionId', 'id');
	}
	// public function tags()
	// {
	// 	return $this->belongsToMany('App\User')->withTimestamps();
	// }


}
