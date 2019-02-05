<?php

namespace App\Http\Controllers;

use App\PlaySessions\AdventureEncounter;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function setup(Request $request, AdventureEncounter $adventureEncounter)
    {
        return view('adventure_encounter.setup', compact('adventureEncounter'));
    }
}
