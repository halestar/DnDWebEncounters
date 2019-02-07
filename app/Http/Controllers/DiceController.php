<?php

namespace App\Http\Controllers;

use App\Dice\DiceParser;
use App\Dice\DiceRoller;
use Illuminate\Http\Request;

class DiceController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function showDialog(Request $request)
	{
		if($request->ajax())
			return view('dice.roll_dialog')->render();
		return redirect()->back();
	}
	
	public function rollDice(Request $request)
	{
		$data = $request->validate(
			[
				'num_dice' => 'required|numeric|min:1|max:10',
				'dice_type' => 'required|numeric|min:4|max:20',
				'mod' => 'required|numeric'
			]
		);
		$diceRoller = new DiceRoller($data['dice_type'], $data['num_dice']);
		$diceRoller->setModifier($data['mod']);
		return $diceRoller->roll();
	}
	
	public function quickRoll(Request $request)
	{
		$roll = $request->input('roll');
		$dice = new DiceParser($roll);
		return $dice->roll();
	}
}
