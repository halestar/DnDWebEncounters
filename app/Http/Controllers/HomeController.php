<?php

namespace App\Http\Controllers;

use App\Players\Pc;
use App\PlaySessions\PlaySession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
	    $numPlayers = Auth::user()->players()->count();
	    $numPcs = Pc::select('characters.*')->join('players', 'characters.player_id', '=', 'players.id')->where('players.user_id', '=', Auth::user()->id)->count();
	    $numCustomMonsters = Auth::user()->customMonsters()->count();
	    $numMonsterTokens = Auth::user()->monsterTokens()->count();
	    $numModules = Auth::user()->modules()->count();
	    $numEncounters = Auth::user()->encounters()->count();
	    $lastActiveSession = Auth::user()->lastActiveSession();
	    $playSessions = Auth::user()->playSessions()->whereNull('ended')->get();
        return view('home',
	        [
		        'numPlayers' => $numPlayers,
		        'numPcs' => $numPcs,
		        'numCustomMonsters' => $numCustomMonsters,
		        'numMonsterTokens' => $numMonsterTokens,
		        'numModules' => $numModules,
		        'numEncounters' => $numEncounters,
		        'lastActiveSession' => $lastActiveSession,
		        'playSessions' => $playSessions,
	        ]);
    }
}
