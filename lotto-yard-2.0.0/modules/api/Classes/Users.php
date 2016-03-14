<?php

require dirname(__FILE__) . '/../Data/Data.php';

class Users extends Data
{
    public function signup()
    {
        $data = $_POST;

        if (isset($this->postData['firstname'])) {
            $data['firstName'] = str_replace('\\', '', $this->postData['firstname']);
        }
        if (isset($this->postData['lastname'])) {
            $data['lastName']  = str_replace('\\', '', $this->postData['lastname']);
        }

        $data['PhoneNumber'] = $this->postData['phone'];
        $data['AffiliateId'] = $_SESSION['bta'] == null ? 0 : $_SESSION['bta'];
        $data['cxd']         = $_SESSION['cxd'] == null ? 0 : $_SESSION['cxd'];
        $data['BrandID']     = BRAND_ID;
        $data['IP']          = $_SERVER['REMOTE_ADDR'];

        $this->processedData = $data;
    }

    public function login()
    {
        $this->processedData = array(
            'email'    => $this->postData['email'],
            'password' => $this->postData['password'],
            'brandId'  => BRAND_ID,
        );
    }

    public function updatePersonalDetails()
    {
        $memberId = 0;
        $password = '';

        if (count($_SESSION['user_data']) > 0) {
            $memberId = $_SESSION['user_data']['MemberId'];
            $password = $_SESSION['user_data']['Password'];
        }

        $this->processedData = array(
            'Email'        => $_SESSION['user_data']['Email'],
            'Password'     => $password,
            'FirstName'    => str_replace('\\', '', $this->postData['first_name']),
            'LastName'     => str_replace('\\', '', $this->postData['last_name']),
            'MemberId'     => $memberId,
            'PhoneNumber'  => $this->postData['phone'],
            'MobileNumber' => $this->postData['mobno'],
            'CountryCode'  => $this->postData['country'],
            'Address'      => $this->postData['address'],
            'City'         => $this->postData['city'],
            'State'        => $this->postData['state'],
            'ZipCode'      => $this->postData['zipcode'],
            'BrandID'      => BRAND_ID,
            'IP'           => $_SERVER['REMOTE_ADDR'],
        );
    }

    public function getPersonalDetailsByMemberid()
    {
        $this->processedData = array(
            'MemberId' => (count($_SESSION['user_data']) > 0) ? $_SESSION['user_data']['MemberId'] : 0,
            'BrandID'  => BRAND_ID,
            'IP'       => $_SERVER['REMOTE_ADDR'],
        );
    }

    public function updatePassword()
    {
        if (!empty($_SESSION['user_data'])) {
            $memberID = $_SESSION['user_data']['MemberId'];
        }

        if (!empty($_SESSION['ResetMemberId'])) {
            $memberID = $_SESSION['ResetMemberId'];
            $_SESSION['user_data']['MemberId'] = $memberID;
        }

        $this->processedData = array(
            'Email'       => $this->postData['email'],
            'Password'    => $this->postData['password'],
            'Oldpassword' => $this->postData['oldpassword'],
            'MemberId'    => $memberID,
            'BrandID'     => BRAND_ID,
            'IP'          => $_SERVER['REMOTE_ADDR'],
        );
    }

    public function getCreditCardMethodsByMemberid()
    {
        $this->processedData = array(
            'MemberId' => $_SESSION['user_data']['MemberId'],
            'BrandID'  => BRAND_ID,
            'IP'       => $_SERVER['REMOTE_ADDR'],
        );
    }

    public function getTransactionsByMemberid()
    {
        $this->processedData = array(
            'MemberId'   => $_SESSION['user_data']['MemberId'],
            'BrandID'    => BRAND_ID,
            'PageNumber' => $this->postData['PageNumber'],
            'PageSize'   => $this->postData['PageSize'],
        );
    }

    public function deleteCreditCard()
    {
        $this->processedData = array(
            'MemberId' => $_SESSION['user_data']['MemberId'],
            'BrandID'  => BRAND_ID,
            'ID'       => $this->postData['id'],
        );
    }

    public function getMemberMoneyBalance()
    {
        if (count($_SESSION['user_data']) > 0) {
            $this->processedData = array(
                'MemberId' => $_SESSION['user_data']['MemberId'],
                'BrandID'  => BRAND_ID,
            );
        }
    }

    public function getPersonalDetailsByEmail()
    {
        $this->processedData = array('Email' => $this->postData['email'], 'BrandID' => BRAND_ID);
    }

    public function addUpdateCreditCard()
    {
        $cardtype = ($this->postData['cardid'] == 0) ? $this->postData['card'] : $this->postData['cardtype'];

        $date     = $this->postData['year'] . '-' . $this->postData['month'];
        $d        = date_create_from_format('Y-m', $date);
        $last_day = date_format($d, 't');
        $date     = $this->postData['year'] . '-' . $this->postData['month'] . '-' . $last_day;

        $this->processedData = array(
            'MemberId'       => $_SESSION['user_data']['MemberId'],
            'BrandID'        => BRAND_ID,
            'ID'             => $this->postData['cardid'],
            'CardHolderName' => $this->postData['fullname'],
            'ExpirationDate' => $date,
            'CVV'            => $this->postData['cvv'],
            'CardType'       => $cardtype
        );

        if ($this->postData['cardid'] == 0) {
            $this->processedData['CreditCardNumber'] = $this->postData['card_num'];
        }
    }
}
