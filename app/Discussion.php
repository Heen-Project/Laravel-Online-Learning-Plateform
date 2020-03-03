<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Model
{
	use SoftDeletes;
	protected $table = 'discussions';
	protected $fillable = ['userId', 'categoryId', 'title', 'status', 'description'];
	// protected $hidden = [''];

	public function creator()
	{
		return $this->belongsTo('App\User', 'userId', 'id');
	}

	public function category()
	{
		return $this->belongsTo('App\LessonCategory', 'categoryId' ,'id');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment', 'discussionId', 'id');
	}
	
}
