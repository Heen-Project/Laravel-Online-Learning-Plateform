<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $table = 'articles';
	protected $fillable = ['userId', 'lessonId', 'title', 'description'];
	// protected $hidden = [''];

	public function creator()
	{
		return $this->belongsTo('App\User', 'userId', 'id');
	}

	public function lesson()
	{
		return $this->belongsTo('App\Lesson', 'lessonId', 'id');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment', 'articleId', 'id');
	}

	public function detailViews()
	{
		return $this->hasMany('App\ViewArticle', 'articleId', 'id');
	}

}
