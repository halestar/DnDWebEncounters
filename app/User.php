<?php

namespace App;

use App\Players\Pc;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles;

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
    
    public function canStartAdventure()
    {
    	$numPlayers = Auth::user()->players()->count();
	    $numPcs = Pc::select('characters.*')->join('players', 'characters.player_id', '=', 'players.id')->where('players.user_id', '=', Auth::user()->id)->count();
	    $numMonsterTokens = Auth::user()->monsterTokens()->count();
	    $numEncounters = Auth::user()->encounters()->count();
	    return ($numPlayers > 0 && $numPcs > 0 && $numMonsterTokens > 0 && $numEncounters > 0);
    }
	
	public function playSessions()
	{
		return $this->hasMany('App\PlaySessions\PlaySession', 'user_id', 'id');
	}
	
	public function hasActiveSessions()
	{
		return ($this->playSessions()->whereNull('ended')->count() > 0);
	}
	
	public function lastActiveSession()
	{
		return $this->playSessions()->whereNull('ended')->orderBy('updated_at', 'DESC')->first();
	}
	
	public function parties()
	{
		return $this->hasMany('App\PlaySessions\Party', 'user_id', 'id');
	}
	
	public function pcs()
	{
		return $this->hasManyThrough('App\Players\Pc', 'App\Players\Player', 'user_id', 'player_id', 'id', 'id');
	}
	
}
