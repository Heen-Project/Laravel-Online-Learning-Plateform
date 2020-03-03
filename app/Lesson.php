<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
	protected $table = 'lessons';
	protected $fillable = ['userId', 'categoryId', 'title', 'description', 'approval', 'adminCheck'];
	// protected $hidden = [''];

	public function creator()
	{
		return $this->belongsTo('App\User', 'userId', 'id');
	}

	public function category()
	{
		return $this->belongsTo('App\LessonCategory', 'categoryId' ,'id');
	}

	public function articles()
	{
		return $this->hasMany('App\Article', 'lessonId', 'id');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment', 'lessonId', 'id');
	}
	
}
