<?php

namespace App\Players;

use Illuminate\Database\Eloquent\Model;

class Pc extends Model
{
	protected $table = 'characters';
	protected $fillable = ['name', 'characterClass', 'characterRace', 'ac', 'hp', 'pp', 'level', 'spellDc'];
	
	public function player()
	{
        return $this->belongsTo('App\Players\Player', 'player_id');
	}
}
