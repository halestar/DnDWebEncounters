<?php

namespace App\Http\Controllers;

use App\Encounters\CustomMonster;
use App\Encounters\Monster;
use App\Encounters\MonsterAbility;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MonsterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('monsters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monsters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $data = $request->validate(
		    [
			    'name' => 'required|max:255',
			    'cr' => 'required|max:10',
			    'monsterType' => 'nullable',
			    'monsterSize' => 'nullable',
			    'alignment' => 'nullable',
			    'resistances' => 'nullable',
			    'immunities' => 'nullable',
			    'vulnerabilities' => 'nullable',
			    'languages' => 'nullable',
			    'senses' => 'nullable',
			    'speed' => 'nullable',
			    'str' => 'required|numeric|min:0',
			    'dex' => 'required|numeric|min:0',
			    'con' => 'required|numeric|min:0',
			    'int' => 'required|numeric|min:0',
			    'wis' => 'required|numeric|min:0',
			    'cha' => 'required|numeric|min:0',
			    'ac' => 'required|numeric|min:0',
			    'hp' => 'required|numeric|min:0'
		    ]
	    );
	    $monster = new CustomMonster();
	    $monster->fill($data);
	    $request->user()->customMonsters()->save($monster);
	    //special abilities.
	    $special_abilities_json = $request->input('special_abilities');
	    if($special_abilities_json != "")
	    {
		    $special_abilities_json = json_decode($special_abilities_json, true);
		    foreach($special_abilities_json as $ability)
		    {
			    $monster->specialAbilities()->create(
				    [
					    'name' => $ability['name'],
					    'description' => $ability['description'],
					    'type' => CustomMonster::$SPECIAL_ABILITY,
				    ]
			    );
		    }
	    }
	    //actions.
	    $actions_json = $request->input('actions');
	    if($actions_json != "")
	    {
		    $actions_json = json_decode($actions_json, true);
		    foreach($actions_json as $ability)
		    {
			    $monster->actions()->create(
				    [
					    'name' => $ability['name'],
					    'description' => $ability['description'],
					    'type' => CustomMonster::$ACTION,
				    ]
			    );
		    }
	    }
	    //legendary abilities.
	    $legendary_abilities_json = $request->input('legendary_abilities');
	    if($legendary_abilities_json != "")
	    {
		    $legendary_abilities_json = json_decode($legendary_abilities_json, true);
		    foreach($legendary_abilities_json as $ability)
		    {
			    $monster->specialAbilities()->create(
				    [
					    'name' => $ability['name'],
					    'description' => $ability['description'],
					    'type' => CustomMonster::$LEGENDARY_ABILITY,
				    ]
			    );
		    }
	    }
	    return redirect()->route('monsters.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomMonster $monster)
    {
        return view('monsters.edit', compact('monster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomMonster $monster)
    {
	    $data = $request->validate(
		    [
			    'name' => 'required|max:255',
			    'cr' => 'required|max:10',
			    'monsterType' => 'nullable',
			    'monsterSize' => 'nullable',
			    'alignment' => 'nullable',
			    'resistances' => 'nullable',
			    'immunities' => 'nullable',
			    'vulnerabilities' => 'nullable',
			    'languages' => 'nullable',
			    'senses' => 'nullable',
			    'speed' => 'nullable',
			    'str' => 'required|numeric|min:0',
			    'dex' => 'required|numeric|min:0',
			    'con' => 'required|numeric|min:0',
			    'int' => 'required|numeric|min:0',
			    'wis' => 'required|numeric|min:0',
			    'cha' => 'required|numeric|min:0',
			    'ac' => 'required|numeric|min:0',
			    'hp' => 'required|numeric|min:0'
		    ]
	    );
	    $monster->fill($data);
	    $monster->save();
	    //special abilities.
	    $special_abilities_json = $request->input('special_abilities');
	    $sync = array();
	    if($special_abilities_json != "")
	    {
		    $special_abilities_json = json_decode($special_abilities_json, true);
		    foreach($special_abilities_json as $ability)
		    {
		    	if($ability['id'] != "")
			    {
			    	$mAb = MonsterAbility::findOrFail($ability['id']);
				    $mAb->fill($ability);
				    $mAb->save();
				    $sync[] = $mAb->id;
			    }
		    	else
			    {
				    $sync[] = $monster->specialAbilities()->create(
					    [
						    'name' => $ability['name'],
						    'description' => $ability['description'],
						    'type' => CustomMonster::$SPECIAL_ABILITY,
					    ]
				    )->id;
				    
			    }
		    }
	    }
	    foreach($monster->specialAbilities as $ability)
	    {
	    	if(!in_array($ability->id, $sync))
	    		$ability->delete();
	    }
	    //actions.
	    $actions_json = $request->input('actions');
	    $sync = array();
	    if($actions_json != "")
	    {
		    $actions_json = json_decode($actions_json, true);
		    foreach($actions_json as $ability)
		    {
		    	if($ability['id'] != "")
			    {
				    $mAb = MonsterAbility::findOrFail($ability['id']);
				    $mAb->fill($ability);
				    $mAb->save();
				    $sync[] = $mAb->id;
			    }
			    else
			    {
				    $sync[] = $monster->actions()->create(
					    [
						    'name' => $ability['name'],
						    'description' => $ability['description'],
						    'type' => CustomMonster::$ACTION,
					    ]
				    )->id;
			    }
		    }
	    }
	    foreach($monster->actions as $ability)
	    {
		    if(!in_array($ability->id, $sync))
			    $ability->delete();
	    }
	    //legendary abilities.
	    $legendary_abilities_json = $request->input('legendary_abilities');
	    $sync = array();
	    if($legendary_abilities_json != "")
	    {
		    $legendary_abilities_json = json_decode($legendary_abilities_json, true);
		    foreach($legendary_abilities_json as $ability)
		    {
			    if($ability['id'] != "")
			    {
				    $mAb = MonsterAbility::findOrFail($ability['id']);
				    $mAb->fill($ability);
				    $mAb->save();
				    $sync[] = $mAb->id;
			    }
			    else
			    {
				    $sync[] = $monster->legendaryAbilities()->create(
					    [
						    'name' => $ability['name'],
						    'description' => $ability['description'],
						    'type' => CustomMonster::$LEGENDARY_ABILITY,
					    ]
				    )->id;
			    }
		    }
	    }
	    foreach($monster->legendaryAbilities as $ability)
	    {
		    if(!in_array($ability->id, $sync))
			    $ability->delete();
	    }
	    return redirect()->route('monsters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomMonster $monster)
    {
	    $monster->delete();
	    return redirect()->route('monsters.index');
    }
    
    public function srList()
    {
    	$monsters = Monster::allSrMonsters();
	    return Datatables::of($monsters)->make(true);
    }
    
	public function customList(Request $request)
	{
		$monsters = CustomMonster::select('custom_monsters.*')->where('custom_monsters.user_id', '=', $request->user()->id);
		return Datatables::of($monsters)->make(true);
	}
}
