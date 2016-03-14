<?php

class Discounts
{
    private $period, $lotteryName, $type;
    private $discounts = array(
        'BonoLoto' => array(
            'single' => array(
                1 => 12,
                2 => 16,
                4 => 16,
            ),
            'group' => array(
                1 => 0,
                2 => 10,
                4 => 15,
            ),
        ),
        'SuperEnalotto' => array(
            'single' => array(
                1 => 3,
                2 => 12,
                4 => 16,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 10,
            ),
        ),
        'ElGordo' => array(
            'single' => array(
                1 => 0,
                2 => 2,
                4 => 4,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'EuroJackpot' => array(
            'single' => array(
                1 => 0,
                2 => 2,
                4 => 4,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'PowerBall' => array(
            'single' => array(
                1 => 2,
                2 => 4,
                4 => 15,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'LaPrimitiva' => array(
            'single' => array(
                1 => 2,
                2 => 4,
                4 => 15,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'MegaMillions' => array(
            'single' => array(
                1 => 2,
                2 => 4,
                4 => 15,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'Lotto649' => array(
            'single' => array(
                1 => 2,
                2 => 4,
                4 => 15,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'UkLotto' => array(
            'single' => array(
                1 => 2,
                2 => 4,
                4 => 15,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'NewYorkLotto' => array(
            'single' => array(
                1 => 2,
                2 => 4,
                4 => 15,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
        ),
        'EuroMillions' => array(
            'single' => array(
                1 => 2,
                2 => 4,
                4 => 15,
            ),
            'group' => array(
                1 => 0,
                2 => 0,
                4 => 0,
            ),
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

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getDiscount()
    {
        $discount = $this->discounts[$this->lotteryName][$this->type][$this->period];
        return ($discount > 0) ? $this->period . ' '.__('week', 'twentythirteen').' ' . $discount . '% '.__('discount', 'twentythirteen').'' : $this->period . ' '.__('week', 'twentythirteen').'';
    }
}
