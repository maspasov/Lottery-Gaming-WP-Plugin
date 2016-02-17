<?php

/**
 * Created by PhpStorm.
 * User: yanislav
 * Date: 9/28/15
 * Time: 16:51 PM
 */

class Discounts
{
    private $period, $lotteryName;
    private $discounts = array(
        'BonoLoto' => array(
            1 => 2,
            2 => 7,
            4 => 10,
        ),
        'SuperEnalotto' => array(
            1 => 0,
            2 => 2,
            4 => 7,
        ),
        'ElGordo' => array(
            1 => 0,
            2 => 0,
            4 => 0,
        ),
        'EuroJackpot' => array(
            1 => 0,
            2 => 0,
            4 => 0,
        ),
        'PowerBall' => array(
            1 => 0,
            2 => 0,
            4 => 5,
        ),
        'LaPrimitiva' => array(
            1 => 0,
            2 => 0,
            4 => 5,
        ),
        'MegaMillions' => array(
            1 => 0,
            2 => 0,
            4 => 5,
        ),
        'Lotto649' => array(
            1 => 0,
            2 => 0,
            4 => 5,
        ),
        'UkLotto' => array(
            1 => 0,
            2 => 0,
            4 => 5,
        ),
    );

    public function setPeriod($period)
    {
        $this->period = $period;
    }

    public function setLotteryName($name)
    {
        $this->lotteryName = $name;
    }

    public function getDiscount()
    {
        $discount = $this->discounts[$this->lotteryName][$this->period];
        return ($discount > 0) ? $this->period . ' '.__('week', 'twentythirteen').' ' . $discount . '% '.__('discount', 'twentythirteen').'' : $this->period . ' '.__('week', 'twentythirteen').'';
    }
}
