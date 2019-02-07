<?php

namespace App\Http\Controllers;

use App\Spells\Spell;
use Illuminate\Http\Request;

class SpellController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function showDialog(Request $request)
	{
		if($request->ajax())
			return view('spells.search')->render();
		return redirect()->back();
	}
	
	public function spellSearch(Request $request)
	{
		$data = $request->validate(['query' => 'required']);
		$query = $data['query'];
		$spells = Spell::allSpells()->filter(function($value) use($query)
		{
			return (stripos($value->name, $query) !== false);
		});
		if($request->ajax())
			return view('spells.search', compact('spells'))->with('query', $query)->render();
		return redirect()->back();
	}
	
	public function showSpell(Request $request, $idx)
	{
		$spell = Spell::allSpells()->get($idx);
		if($request->ajax())
			return view('spells.display', compact('spell'))->render();
		return redirect()->back();
	}
}
