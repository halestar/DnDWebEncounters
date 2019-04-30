<?php

namespace App\PlaySessions;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
	protected $table = 'party';
	protected $guarded = ['id', 'user_id'];
	
	public function playSessions()
	{
        return $this->hasMany('App\PlaySessions\PlaySession', 'party_id');
	}
	
	public function user()
	{
        return $this->belongsTo('App\User', 'user_id');
	}
	
	public function pcs()
	{
		return $this->belongsToMany('App\Players\Pc', 'party_pc', 'party_id', 'character_id');
	}
}
