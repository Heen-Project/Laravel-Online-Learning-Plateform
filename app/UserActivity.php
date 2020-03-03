<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
	protected $table = 'user_activities';
	protected $fillable = ['userId', 'destinationId', 'typeId','point', 'content', 'description'];

	public function creator()
	{
		return $this->belongsTo('App\User', 'userId', 'id');
	}
}
