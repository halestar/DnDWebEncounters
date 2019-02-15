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
    
    public function settings(Request $request)
    {
    	$user = $request->user();
    	return view('settings', compact('user'));
    }
    
    public function saveSettings(Request $request)
    {
        $data = $request->validate(
        	[
        	    'name' => 'required|max:255',
		        'password' => 'nullable|confirmed|min:8',
		        'avatar_url' => 'nullable|url',
		        'monster_initiative' => 'checkbox',
		        'monster_hp' => 'checkbox',
	        ]
        );
        $user = $request->user();
        $user->name = $data['name'];
        $user->avatar_url = $data['avatar_url'];
	    $user->monster_initiative = $data['monster_initiative'];
	    $user->monster_hp = $data['monster_hp'];
	    if(isset($data['password']))
	        $user->password = bcrypt($data['password']);
	    $user->save();
	    return redirect()->route('settings')->with('success_message', 'Settings Updated');
    }
}
