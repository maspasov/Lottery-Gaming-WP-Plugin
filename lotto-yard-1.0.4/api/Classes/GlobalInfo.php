<?php

/**
 * Created by PhpStorm.
 * User: yanislav
 * Date: 9/9/15
 * Time: 3:10 PM
 */

require dirname(__FILE__) . '/../Data/Data.php';

class GlobalInfo extends Data
{
    public function getAllBrandDraws()
    {
        $this->processedData = array(
            'BrandId'           => BRAND_ID,
            'BasePricesEnabled' => true,
        );
    }

    public function getPricesAndDiscounts()
    {
        $this->processedData = array(
            'BrandID'       => BRAND_ID,
            'NumberOfDraws' => 1,
            'ProductId'     => 3,
        );
    }

    public function getLotteriesLastResultsPrizes()
    {
        $this->processedData = array(
            'NumberOfResults' => 1,
            'BrandID'         => BRAND_ID
        );
    }

    public function lotteryRules()
    {
        $this->processedData = array(
            'BrandID' => BRAND_ID,
            'ltype'   => $this->postData['lt'],
        );
    }

    public function __call($name, $arguments)
    {
        $this->processedData = array();
    }
}
