<?php

namespace App\PlaySessions;

use Illuminate\Database\Eloquent\Model;

class AdventureEncounter extends Model
{
    protected $table = 'adventure_encounters';
    
    public function playSession()
    {
        return $this->belongsTo('App\PlaySessions\PlaySession', 'id', 'play_session_id');
    }
}
