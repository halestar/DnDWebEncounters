<?php
/**
 * Created by PhpStorm.
 * User: gkalinec
 * Date: 2/5/2019
 * Time: 4:08 PM
 */

namespace App\Dice;


class InitiativeRoller extends DiceRoller
{
    public function __construct($mod)
    {
        parent::__construct(20, 1);
        $this->modifier = $mod;
    }
}
