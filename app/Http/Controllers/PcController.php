<?php

namespace App\Http\Controllers;

use App\Players\Pc;
use App\Players\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PcController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	    $players = $request->user()->players;
	    return view('characters.index', compact('players'))->with('selectedPlayer', 'ALL');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
	    $players = $request->user()->players;
	    return view('characters.create', compact('players'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$player = Player::findOrFail($request->input('player_id'));
	    $data = $request->validate(
		    [
			    'name' => 'required|max:255',
			    'characterRace' => 'nullable',
			    'characterClass' => 'nullable',
			    'level' => 'required|numeric|min:1|max:20',
			    'ac' => 'required|numeric|min:0',
			    'hp' => 'required|numeric|min:0',
			    'pp' => 'required|numeric|min:0',
			    'spellDc' => 'nullable|numeric',
		    ]
	    );
	    $pc = new Pc();
	    $pc->fill($data);
	    $player->pcs()->save($pc);
	    return redirect()->route('pcs.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pc $pc)
    {
	    return view('characters.edit', compact('pc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pc $pc)
    {
	    $data = $request->validate(
		    [
			    'name' => 'required|max:255',
			    'characterRace' => 'nullable',
			    'characterClass' => 'nullable',
			    'level' => 'required|numeric|min:1|max:20',
			    'ac' => 'required|numeric|min:0',
			    'hp' => 'required|numeric|min:0',
			    'pp' => 'required|numeric|min:0',
			    'spellDc' => 'nullable|numeric',
		    ]
	    );
	    $pc->fill($data);
	    $pc->save();
	    return redirect()->route('pcs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pc $pc)
    {
	    $pc->delete();
	    return redirect()->route('pcs.index');
    }
	
	public function pcList(Request $request, $selectedPlayer)
	{
		Log::debug("in PcController::pcList, selected player: " . $selectedPlayer);
		if($selectedPlayer == 'ALL')
		{
			$query = Pc::select('characters.*')->join('players', 'players.id', '=', 'characters.player_id')
				->where('players.user_id', '=', $request->user()->id);
		}
		else
		{
			$player = Player::findOrFail($selectedPlayer);
			$query = $player->pcs();
			Log::debug("from PcController::pcList, query: " . $query->get());
		}
		return Datatables::of($query)->make(true);
	}
	
	public function playerIndex(Request $request, Player $player)
	{
		$selectedPlayer = $player->id;
		$players = $request->user()->players;
		return view('characters.index', compact('players'))->with('selectedPlayer', $selectedPlayer);
	}
}
