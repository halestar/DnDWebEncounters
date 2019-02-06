<?php
/**
 * Created by PhpStorm.
 * User: adming
 * Date: 2/5/2019
 * Time: 11:44 AM
 */

namespace App\Dice;


use Illuminate\Support\Collection;
use Log;

class DiceParser
{
	protected $diceStr;
	protected $dice;
	
	public function __construct($roll)
	{
	    Log::debug("In Dice Parser, str is " . $roll);
		$this->diceStr = $roll;
		$this->dice = new Collection();
		$this->parseDice();
		Log::debug("After pasrcin, dice are: " . print_r($this->dice, true));
	}
	
	private function parseDice()
	{
	    Log::debug("In parseDice()");
		$diceTokens = preg_split('/[+-]/', $this->diceStr);
		Log::debug('dice tokens: ' . print_r($diceTokens, true));
		$currentDice = null;
		$currentSign = "+";
		$currentMod = "";
		foreach($diceTokens as $token)
		{
		    Log::debug("Token is: " . $token);
			if($token == "+" || $token == "-")
			{
			    Log::debug("setting currentSign to token");
				$currentSign = $token;
			}
            elseif(preg_match("/\d*[dD]\d+/", $token) == 1)
            {
                Log::debug("Matched dice");
                $diceExpr = preg_split("/[dD]/", $token);
                Log::debug("diceExpr is " . print_r($diceExpr, true));
                if(count($diceExpr) == 2)
                {
                    if($currentDice != null)
                        $this->dice[] = $currentDice;
                    $numDice = (int)$diceExpr[0];
                    $numFaces = (int)$diceExpr[1];
                    Log::debug("Will attempt to build a die with " . $numFaces . " faces and " . $numDice . " dice");
                    $currentDice = new DiceRoller($numFaces, $numDice);
                    $currentDice->setRollSign($currentSign);
                    Log::debug("currentDice is now " . print_r($currentDice, true));
                }
                else
                    throw new \Exception("Error parting die: " . $this->diceStr);
            }
			elseif(preg_match('/\d+/', $token) == 1)
			{
			    Log::debug("Matched a string of digits");
				$currentMod = (int)$token;
				if($currentSign == "-")
					$currentMod *= -1;
				if($currentDice != null)
				{
					$currentDice->setModifier($currentMod);
					$this->dice[] = $currentDice;
					$currentDice = null;
				}
				$currentSign = "+";
			}
		}
		Log::debug("after parsing, currentDice is " . print_r($currentDice, true));
		if($currentDice != null)
			$this->dice[] = $currentDice;
	}
	
	public function getDiceStr()
	{
		return $this->diceStr;
	}
	
	public function roll()
	{
	    Log::debug("In DiceParser@roll(), dice are: " . print_r($this->dice, true));
		$result = 0;
		foreach($this->dice as $d)
			$result += $d->roll();
		Log::debug("Final Dice parser roll is " . $result);
		return $result;
	}
	
	public static function parseString($str)
	{
		$matches = [];
		preg_match("/\b(\d*[dD](4|6|8|10|12|20)(\s*[+|-]\s*\d)?)\b/", $str, $matches);
		$dice = array();
		foreach($matches as $match)
		{
			$diceStr = str_replace(" ", "", $match);
			$dice[] = new DiceParser($diceStr);
		}
		return $dice;
	}
}
