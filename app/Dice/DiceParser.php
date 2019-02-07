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
	}
	
	private function parseDice()
	{
		$diceTokens = preg_split('/[+-]/', $this->diceStr);
		$currentDice = null;
		$currentSign = "+";
		$currentMod = "";
		foreach($diceTokens as $token)
		{
		    Log::debug("Token is: " . $token);
			if($token == "+" || $token == "-")
			{
				$currentSign = $token;
			}
            elseif(preg_match("/\d*[dD]\d+/", $token) == 1)
            {
                $diceExpr = preg_split("/[dD]/", $token);
                if(count($diceExpr) == 2)
                {
                    if($currentDice != null)
                        $this->dice[] = $currentDice;
                    $numDice = (int)$diceExpr[0];
                    $numFaces = (int)$diceExpr[1];
                    $currentDice = new DiceRoller($numFaces, $numDice);
                    $currentDice->setRollSign($currentSign);
                }
                else
                    throw new \Exception("Error parting die: " . $this->diceStr);
            }
			elseif(preg_match('/\d+/', $token) == 1)
			{
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
		if($currentDice != null)
			$this->dice[] = $currentDice;
	}
	
	public function getDiceStr()
	{
		return $this->diceStr;
	}
	
	public function roll()
	{
		$result = 0;
		foreach($this->dice as $d)
			$result += $d->roll();
		return $result;
	}
	
	public static function parseString($str)
	{
		$matches = [];
		preg_match_all("/\b(\d*[dD][4|6|8|10|12|20](?:\s*[+|-]\s*\d)?)\b/", $str, $matches);
		$matches = array_unique($matches[0]);
		Log::debug('in DiceParser@parseString, matches: ' . print_r($matches, true));
		$dice = array();
		foreach($matches as $match)
		{
			$diceStr = str_replace(" ", "", $match);
			$dice[] = new DiceParser($diceStr);
		}
		return $dice;
	}
}
