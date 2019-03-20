<?php

namespace App\Http\Controllers;

use App\Players\Pc;
use App\PlaySessions\Party;
use App\PlaySessions\PlaySession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PartyController extends Controller
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
	    session(['new_party_return' => $request->fullUrl()]);
        return view('play_session.party.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function create(Request $request)
	{
		session(['new_pc_return' => $request->fullUrl()]);
		return view('play_session.party.create');
	}
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PlaySession $playSession)
    {
	    $data = $request->validate(
		    [
			    'name' => 'required|max:255',
			    'pcs' => 'nullable|array',
		    ]
	    );
	    $party = new Party();
	    $party->name = $data['name'];
	    $apl = 0;
	    foreach($data['pcs'] as $pc_id)
	    {
		    $pc = Pc::findOrFail($pc_id);
		    $apl += $pc->level;
	    }
	    $party->apl = floor($apl / count($data['pcs']));
	    $request->user()->parties()->save($party);
	    $party->pcs()->sync($data['pcs']);
	    $returnRoute = session('new_party_return', route('parties.index'));
	    return redirect($returnRoute);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
	    $party = Party::findOrFail($id);
	    session(['new_pc_return' => $request->fullUrl()]);
	    Log::debug("in edit new_party_return=" . session('new_party_return'));
	    return view('play_session.party.edit', compact('party'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	    Log::debug("in edit new_party_return=" . session('new_party_return'));
	    $data = $request->validate(
		    [
			    'name' => 'required|max:255',
			    'pcs' => 'nullable|array',
		    ]
	    );
	    Log::debug("pcs = " . print_r($data['pcs'], true));
	    $party = Party::findOrFail($id);
	    $party->name = $data['name'];
	    $apl = 0;
	    $ids = array();
	    foreach($data['pcs'] as $pc_id)
	    {
		    $pc = Pc::findOrFail($pc_id);
		    $apl += $pc->level;
		    $ids[] = $pc_id;
	    }
	    $party->apl = floor($apl / count($data['pcs']));
	    $party->save();
	    $party->pcs()->sync($ids);
	    $returnRoute = session('new_party_return', route('parties.index'));
	    return redirect($returnRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party = Party::findOrFail($id);
        $party->delete();
        return redirect()->route('parties.index');
    }
	
	public function partyList(Request $request)
	{
		$parties = Party::where('party.user_id', '=', $request->user()->id)->with('pcs');
		return Datatables::of($parties)->make(true);
	}
}
