<?php

namespace App\Http\Controllers;

use App\Encounters\CustomMonster;
use App\Encounters\Encounter;
use App\Encounters\EncounterMonster;
use App\Encounters\Monster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class EncounterController extends Controller
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
    public function index()
    {
        return view('encounters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('encounters.create');
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
                'cr' => 'required|numeric|min:0',
            ]
        );
        $encounter = new Encounter();
        $encounter->fill($data);
        
        //monsters
        $monster_json = $request->input('monsters');
        if($monster_json != "")
        {
            $monster_json = json_decode($monster_json, true);
            Log::debug("monster_json: " . print_r($monster_json, true));
            $srMonsters = [];
            $customIds = [];
            foreach($monster_json as $monster)
            {
                if(isset($monster['monster_id']))
                    $customIds[] = $monster['monster_id'];
                else
                    $srMonsters[] = $monster;
            }
            $encounter->srMonsters = $srMonsters;
            $request->user()->encounters()->save($encounter);
            $encounter->customMonsters()->attach($customIds);
        }
        return redirect()->route('encounters.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Encounter $encounter)
    {
        Log::debug('encounter monsters: ' . print_r($encounter->srMonsters, true));
        return view('encounters.edit', compact('encounter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Encounter $encounter)
    {
        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'cr' => 'required|numeric|min:0',
            ]
        );
        $encounter->fill($data);
    
        //monsters
        $monster_json = $request->input('monsters');
        $encounter->srMonsters = "";
        $encounter->customMonsters()->detach();
        if($monster_json != "")
        {
            $monster_json = json_decode($monster_json, true);
            Log::debug("monster_json: " . print_r($monster_json, true));
            $srMonsters = [];
            $customIds = [];
            foreach($monster_json as $monster)
            {
                if(isset($monster['monster_id']))
                    $customIds[] = $monster['monster_id'];
                else
                    $srMonsters[] = $monster;
            }
            $encounter->srMonsters = $srMonsters;
            $encounter->save();
            $encounter->customMonsters()->attach($customIds);
        }
        return redirect()->route('encounters.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Encounter $encounter)
    {
        $encounter->delete();
        return redirect()->route('encounters.index');
    }
    
    public function encounterList(Request $request)
    {
        $encounters = Encounter::where('encounters.user_id', '=', $request->user()->id);
        return Datatables::of($encounters)->make(true);
    }
}
