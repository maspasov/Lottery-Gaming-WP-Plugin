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

    public function replaceMemberId($data)
    {
        $memberId = 0;

        if (!empty($_SESSION['user_data']['MemberId'])) {
            $memberId = $_SESSION['user_data']['MemberId'];
        }
        return str_replace("{0}", $memberId, $data);
    }

    public function parseStringToArray($string)
    {
        $tempData = str_replace("\\", "", $string);
        return json_decode($tempData, true);
    }

    private function setBrandID()
    {
        $this->processedData['BrandID'] = BRAND_ID;
    }
}
