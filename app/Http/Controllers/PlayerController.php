<?php

namespace App\Http\Controllers;

use App\Players\Player;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PlayerController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function playerList(Request $request)
	{
		$query = $request->user()->players()->select('name','dci','id');
		return Datatables::of($query)->make(true);
	}
	
    public function index(Request $request)
    {
        $players = $request->user()->players;
        return view('players.index', compact('players'));
    }
    
    public function create(Request $request)
    {
        return view('players.create');
    }
    
    public function store(Request $request)
    {
    	$data = $request->validate(
    		[
    			'name' => 'required|max:255',
			    'dci' => 'numeric|nullable',
			    'portrait' => 'mimes:jpeg,bmp,png|nullable',
		    ]
	    );
    	$player = new Player();
    	$player->name = $data['name'];
    	$player->dci = $data['dci'];
    	$file = $request->file('portrait');
    	if($file)
	    {
	    	$contents = $file->openFile()->fread($file->getSize());
	    	$player->portrait = $contents;
	    }
    	$request->user()->players()->save($player);
    	return redirect()->route('players.list');
    }
    
    public function showPortrait(Request $request, $id)
    {
    	$player = Player::findOrFail($id);
    	if($player->user_id != $request->user()->id)
    		return abort(404, "Permission denied");
    	return $player->portrait;
    }
}
