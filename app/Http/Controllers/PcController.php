<?php

namespace App\Http\Controllers;

use App\Players\Pc;
use App\Players\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Validator;
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
	    session(['new_pc_return' => $request->fullUrl()]);
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
    	
	    $v = Validator::make($request->all(),
		    [
		    	'player_type' => ['required', Rule::in('EXISTING', 'NEW')],
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
	    $v->sometimes('player_id', 'required|numeric', function($input)
	    {
	    	return ($input->player_type == "EXISTING");
	    });
	    $v->sometimes('new_player_name', 'required', function($input)
	    {
		    return ($input->player_type == "NEW");
	    });
	    $data = $v->validate();
	    $player = null;
	    if($data['player_type'] == "NEW")
	    {
	        $player = new Player();
	        $player->name = $data['new_player_name'];
	        $request->user()->players()->save($player);
	    }
	    else
		    $player = Player::findOrFail($data['player_id']);
	    $pc = new Pc();
	    $pc->fill($data);
	    $player->pcs()->save($pc);
	    $returnRoute = session('new_pc_return', route('pcs.index'));
	    return redirect($returnRoute);
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
	    $returnRoute = session('new_pc_return', route('pcs.index'));
	    return redirect($returnRoute);
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
	
	public function characterList(Request $request)
	{
		$pcs = Pc::select('characters.*')->join('players', 'players.id', '=', 'characters.player_id')
			->where('players.user_id', '=', $request->user()->id)->with('player')->get();
		return response()->json($pcs, 200);
	}
}
