<?php

namespace App\Encounters;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    protected $fillable = ['name', 'description', 'tier', 'optimized_level'];
    
    
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
    
    public function encounters()
    {
        return $this->belongsToMany('App\Encounters\Encounter', 'modules_encounters');
    }
}
