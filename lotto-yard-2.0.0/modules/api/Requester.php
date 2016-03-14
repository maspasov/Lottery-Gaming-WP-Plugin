<?php

class Requester
{
    private $response;

    public function sendRequest($dataString, $methodUrl)
    {
        $url = BASE_API_URL . $methodUrl;
        $ch  = curl_init($url);

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Token: ' . TOKEN
            )
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $resultData = curl_exec($ch);
        $status     = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $this->response = array('resultData' => $resultData, 'status' => $status);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}
