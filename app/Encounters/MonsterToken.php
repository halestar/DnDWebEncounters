<?php

namespace App\Encounters;

use Illuminate\Database\Eloquent\Model;

class MonsterToken extends Model
{
    public static $TOKEN_TYPE_NUMBER = "NUMBER";
    public static $TOKEN_TYPE_COLOR = "COLOR";
    public static $TOKEN_TYPE_COLORED_NUMBER = "COLORED_NUMBER";
    public static $TOKEN_TYPE_MINI = "MINI";
    protected $table = 'monster_tokens';
    protected $guarded = ['id', 'user_id', 'mini'];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
