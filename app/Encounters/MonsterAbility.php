<?php

namespace App\Encounters;

use Illuminate\Database\Eloquent\Model;

class MonsterAbility extends Model
{
	protected $table = 'monster_ability';
	protected $guarded = ['id', 'user_id'];
	
	public function monster()
	{
		return $this->belongsTo('App\Encounters\CustomMonster', 'id', 'monster_id');
	}
}
