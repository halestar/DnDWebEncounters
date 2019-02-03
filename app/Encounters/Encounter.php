<?php

namespace App\Encounters;

use Illuminate\Database\Eloquent\Model;

class Encounter extends Model
{
    protected $table = 'encounters';
    protected $fillable = ['name', 'cr'];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
    
    public function customMonsters()
    {
        return $this->belongsToMany('App\Encounters\CustomMonster', 'encounter_monsters');
    }
    
    public function getSrMonstersAttribute()
    {
        return json_decode($this->attributes['sr_monsters'], true);
    }
    
    public function setSrMonstersAttribute($val)
    {
        $this->attributes['sr_monsters'] = json_encode($val);
    }
}
