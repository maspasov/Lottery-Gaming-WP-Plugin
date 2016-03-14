<?php

require dirname(__FILE__) . '/../Data/Data.php';
class Cashier extends Data
{
    public function prepareOrder()
    {
        $data = $this->parseStringToArray($this->postData['data']);
        $data = $this->replaceMemberId($data);
        $this->processedData = $data;
    }

    public function processorConfirmOrder()
    {
        $data = $this->parseStringToArray($this->postData['data']);
        $data['SessionId'] = empty($_SESSION['user_data']['UserSessionId']) ? 0 : $_SESSION['user_data']['UserSessionId'];
        $data['AffiliateId'] = empty($_SESSION['bta']) ? 0 : $_SESSION['bta'];
        $data['PhoneOrEmail'] = $_SESSION['user_data']['Email'];
        $data['IP'] = $_SERVER['REMOTE_ADDR'];
        $utm_code = '';
        if (!empty($_SESSION["utm_campaign"])) {
            $utm_code = $_SESSION["utm_campaign"];
        }
        $data = str_replace("{emailcode}", $utm_code, $data);

        $this->processedData = $this->replaceMemberId($data);
    }

    public function getMemberPaymentMethods()
    {
        $data = $this->parseStringToArray($this->postData['data']);
        $this->processedData = $this->replaceMemberId($data);
    }

    public function depositFunds()
    {
        $data = $this->parseStringToArray($this->postData['data']);
        $data['SessionId'] = empty($_SESSION['user_data']['UserSessionId']) ? 0 : $_SESSION['user_data']['UserSessionId'];
        $this->processedData = $this->replaceMemberId($data);
    }
}
