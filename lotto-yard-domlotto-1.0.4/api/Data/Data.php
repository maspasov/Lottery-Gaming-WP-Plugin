<?php

/**
 * Created by PhpStorm.
 * User: yanislav
 * Date: 9/10/15
 * Time: 9:54 AM
 */

class Data
{
    protected $postData, $processedData = array();

    public function __construct($postData)
    {
        $this->postData = $postData;
    }

    /**
     * @return mixed
     */
    public function getProcessedData()
    {
        self::setBrandID();
        return json_encode($this->processedData);
    }

    private function setBrandID()
    {
        $this->processedData['BrandID'] = BRAND_ID;
    }
}
