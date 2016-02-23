<?php

class ErrorHandler
{
    protected $action, $data;

    protected function isResponseOkay($response)
    {
        $this->handleData($response['resultData']);
        return true;

//        if (self::checkResponseStatus($response['status'])) {
//            return self::handleData($response['resultData']);
//        }
//
//        return false;
    }

    private function checkResponseStatus($statusCode)
    {
        if ($statusCode == 200) {
            return true;
        } else {
            $this->data = 'Something went wrong, please try again later.';
        }

        return false;
    }

    private function handleData($resultData)
    {
        $decodedData = json_decode($resultData, true);
        $result = false;

        if (is_array($decodedData) || is_object($decodedData)) {
            $data = $decodedData;
            if (!isset($data->ErrorMessage) || !isset($data[0]->ErrorMessage)) {
                $result = true;
            }
        } else {
            $data = $resultData;
        }

        $this->data = $data;

        return $result;
    }
}
