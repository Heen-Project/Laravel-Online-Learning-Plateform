<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewArticle extends Model
{
	protected $table = 'view_articles';
	protected $fillable = ['userId', 'articleId', 'categoryId'];

	public function viewer()
	{
		return $this->belongsTo('App\User', 'userId', 'id');
	}

	public function article()
	{
		return $this->belongsTo('App\Article', 'articleId', 'id');
	}

	public function category()
	{
		return $this->belongsTo('App\LessonCategory', 'categoryId', 'id');
	}

}
