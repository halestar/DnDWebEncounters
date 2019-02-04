<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function players()
    {
    	return $this->hasMany('App\Players\Player', 'user_id', 'id');
    }
	
	public function customMonsters()
	{
		return $this->hasMany('App\Encounters\CustomMonster', 'user_id', 'id');
	}
    
    public function encounters()
    {
        return $this->hasMany('App\Encounters\Encounter', 'user_id', 'id');
    }
    
    public function monsterTokens()
    {
        return $this->hasMany('App\Encounters\MonsterToken', 'user_id', 'id');
    }
    
    public function modules()
    {
        return $this->hasMany('App\Encounters\Module', 'user_id', 'id');
    }
}
