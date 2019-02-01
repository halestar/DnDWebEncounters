<?php

namespace App\Players;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	protected $table = 'players';
	protected $fillable = ['name', 'dci', 'potrait'];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'id', 'user_id');
	}
	
    public function getRouteKeyName()
    {
        return 'id';
    }
}
