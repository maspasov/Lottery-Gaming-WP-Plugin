<?php

class ErrorHandler
{
    protected $data;

    protected function isResponseOkay($response)
    {
        if (self::checkResponseStatus($response['status'])) {
            return self::handleData($response['resultData']);
        }

        return false;
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
        $result      = false;

        if (is_array($decodedData)) {
            if (isset($decodedData['ErrorMessage'])) {
                $this->data = array('error_msg' => $decodedData['ErrorMessage']);
            } else if (isset($decodedData[0]['ErrorMessage'])) {
                $this->data = array('error_msg' => $decodedData[0]['ErrorMessage']);
            } else {
                $this->data = $decodedData;
                $result     = true;
            }
        } else {
            $this->data = array('error_msg' => $decodedData);
        }

        return $result;
    }
}
