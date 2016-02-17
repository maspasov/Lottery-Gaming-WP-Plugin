<?php

/**
 * Created by PhpStorm.
 * User: yanislav
 * Date: 9/11/15
 * Time: 4:34 PM
 */

class DataMapper
{
    private $postData;

    public function __construct($postData)
    {
        $this->postData = $postData;
    }

    public function getLotteryByDrawId($data)
    {
        $temp = array();
        foreach ($data as $key => $value) {
            if ($this->postData['drid'] == $value->DrawId) {
                $temp[] = $value;
            }
        }

        return $temp;
    }

    public function getLotteryTypeId($data)
    {
        $temp = array();
        foreach ($data as $key => $value) {
            if ($this->postData['lt'] == $value->LotteryTypeId) {
                $temp[] = $value;
            }
        }

        return $temp;
    }

    public function getLotteryTypeByName($data)
    {
        $temp = array();
        foreach ($data as $key => $value) {
            if (strcasecmp($this->postData['lt'], $value->LotteryType) == 0) {
                $temp[] = $value;
            }
        }

        return $temp;
    }

    public function getMethodDetails($data)
    {
        foreach ($data as $key => $value) {
            if ($this->postData['id'] == $value->Id) {
                $value->day   = date("d", strtotime($value->ExpirationDate));
                $value->month = date("m", strtotime($value->ExpirationDate));
                $value->year  = date("Y", strtotime($value->ExpirationDate));

                return $value;
            }
        }

        return false;
    }
}
