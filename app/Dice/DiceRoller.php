<?php
/**
 * Created by PhpStorm.
 * User: adming
 * Date: 2/5/2019
 * Time: 11:49 AM
 */

namespace App\Dice;


class DiceRoller
{
	protected $modifier;
	protected $numSides;
	protected $numDice;
	protected $rollSign;
	
	public function __construct($numSides, $numDice)
	{
		$this->numSides = $numSides;
		$this->numDice = $numDice;
		$this->modifier = 0;
		$this->rollSign = "+";
	}
	
	public function getModifier()
	{
		return $this->modifier;
	}
	
	public function setModifier($val)
	{
		$this->modifier = $val;
	}
	
	public function setRollSign($rollSign)
	{
		$this->rollSign = $rollSign;
	}
	
	public function roll()
	{
		$roll = 0;
		for($i = 0; $i < $this->numDice; $i++)
		{
			$randNum = rand(1, $this->numSides);
			$roll += $randNum;
		}
		$roll += $this->modifier;
		if($this->rollSign == "-")
			$roll *= -1;
		return $roll;
	}
}