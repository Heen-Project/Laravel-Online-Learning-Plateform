<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonCategory extends Model
{
	protected $table = 'lesson_categories';
	protected $fillable = ['category'];
	// protected $hidden = [''];

	public function lessons()
	{
		return $this->hasMany('App\Lesson', 'categoryId', 'id');
	}

	public function discussions()
	{
		return $this->hasMany('App\Discussion', 'categoryId', 'id');
	}

	public function articleView()
	{
		return $this->belongsTo('App\ViewArticle', 'categoryId', 'id');
	}
	
}
