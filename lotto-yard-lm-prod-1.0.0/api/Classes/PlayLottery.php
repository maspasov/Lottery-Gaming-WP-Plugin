<?php

/**
 * Created by PhpStorm.
 * User: yanislav
 * Date: 9/10/15
 * Time: 10:53 AM
 */

require dirname(__FILE__) . '/../Data/Data.php';

class PlayLottery extends Data
{
    private $num_of_draws_group_per_week = array(
        'POWERBALL'     => 2,
        'MEGAMILLIONS'  => 2,
        'LOTTO649'      => 2,
        'LAPRIMITIVA'   => 2,
        'EUROMILLIONS'  => 2,
        'EUROJACKPOT'   => 1,
        'ELGORDO'       => 1,
        'SUPERENALOTTO' => 3,
        'BONOLOTO'      => 6,
        'UKLOTTO'       => 2,
        'NEWYORKLOTTO'  => 2,
    );

    public function getProductsByMemberid()
    {
        $this->processedData = array(
            'PageNumber' => $this->postData['PageNumber'],
            'PageSize'   => 25,
            'MemberId'   => $_SESSION['user_data']['MemberId'],
            'BrandID'    => BRAND_ID,
            'IP'         => $_SERVER['REMOTE_ADDR'],
        );
    }

    public function getDrawsTicketsByMemberid()
    {
        $this->processedData = array(
            'PageNumber' => $this->postData['PageNumber'],
            'MemberId'   => $_SESSION['user_data']['MemberId'],
            'BrandID'    => BRAND_ID,
        );
    }

    public function quickPickSelect()
    {
        $data = array(
            'LotteryType' => $this->postData['lotterytype'],
            'BrandID'     => BRAND_ID,
            'bta'         => $this->postData['bta'],
            'prc'         => $this->postData['prc'],
            'sub'         => $this->postData['sub'],
        );

        if (! empty($this->postData['ProductId'])) {
            $data['ProductId'] = $this->postData['ProductId'];
        }
        if (! empty($this->postData['draws'])) {
            $data['Draws'] = $this->postData['draws'];
        }
        if (! empty($this->postData['shares'])) {
            $data['Shares'] = $this->postData['shares'];
        }
        if (! empty($this->postData['lines'])) {
            $data['Lines'] = $this->postData['lines'];
        }

        // Navidad shares
        if (! empty($this->postData['shares'])) {
            $data['shares'] = $this->postData['shares'];
        }

        $this->processedData = $data;
    }

    public function insertMembersProductsWithDraws()
    {
        $otherdata = explode('|', $this->postData['otherdata']);

        $draws = null;
        if ($this->postData['single_drawop'] == 1) {
            $draws = $this->postData['single_drawop'];
        }
        if ($this->postData['single_drawop'] == 2) {
            $draws = $this->postData['single_totaldraw'];
        }
        if ($this->postData['single_drawop'] == 3) {
            $draws = $this->postData['single_subs'] * $this->num_of_draws_group_per_week[strtoupper($otherdata[1])];
        }

        $this->postData['selno'] = trim($this->postData['selno'], '|');
        $this->postData['storeselected'] = trim($this->postData['storeselected'], '|');
        $_SESSION['user_selection'][$otherdata[1]] = $this->postData;

        $this->processedData = array(
            'BrandID'         => BRAND_ID,
            'LotteryType'     => $otherdata[1],
            'SelectedNumbers' => trim($this->postData['selno'], '|'),
            'NumberOfDraws'   => $draws,
            'Trackingdata'    => $_SESSION['utm_campaign'],
        );

        if (isset($_SESSION['user_data']['MemberId'])) {
            $this->processedData['MemberId'] = $_SESSION['user_data']['MemberId'];
        }
    }

    public function insertMembersProductsWithDrawsFreeSingleLine()
    {
        $otherdata = explode('|', $this->postData['otherdata']);

        $draws = null;
        if ($this->postData['single_drawop'] == 1) {
            $draws = $this->postData['single_drawop'];
        }
        if ($this->postData['single_drawop'] == 2) {
            $draws = $this->postData['single_totaldraw'];
        }
        if ($this->postData['single_drawop'] == 3) {
            $draws = $this->postData['single_subs'] * $this->num_of_draws_group_per_week[strtoupper($otherdata[1])];
        }

        $this->postData['selno'] = trim($this->postData['selno'], '|');
        $this->postData['storeselected'] = trim($this->postData['storeselected'], '|');
        $_SESSION['user_selection'][$otherdata[1]] = $this->postData;

        $this->processedData = array(
            'MemberId'        => $_SESSION['user_data']['MemberId'],
            'BrandID'         => BRAND_ID,
            'LotteryType'     => $otherdata[1],
            'SelectedNumbers' => trim($this->postData['selno'], '|'),
            'NumberOfDraws'   => $draws,
        );
    }

    public function getDrawsByMemberid()
    {
        $this->processedData = array(
            'MemberId'   => $_SESSION['user_data']['MemberId'],
            'BrandID'    => BRAND_ID,
            'PageNumber' => $this->postData['pageno']
        );
    }

    public function insertMembersGroups()
    {
        $otherdata = explode('|', $this->postData['otherdata']);

        $draws = null;
        if ($this->postData['group_drawop'] == 1) {
            $draws = $this->postData['group_drawop'];
        }
        if ($this->postData['group_drawop'] == 2) {
            $draws = $this->postData['group_totaldraw'];
        }
        if ($this->postData['group_drawop'] == 3) {
            $draws = $this->postData['group_subs'] * $this->num_of_draws_group_per_week[strtoupper($otherdata[1])];
        }

        $_SESSION['user_selection'][$otherdata[1]] = $this->postData;

        $this->processedData = array(
            'MemberId'       => $_SESSION['user_data']['MemberId'],
            'BrandID'        => BRAND_ID,
            'LotteryType'    => $otherdata[1],
            'ProductId'      => $this->postData['productid'],
            'NumberOfDraws'  => $draws,
            'NumberOfGroups' => $this->postData['quantity'],
            'TrackingData'   => $_SESSION['utm_campaign'],
        );
    }

    public function getNavidadNumbers()
    {
        $this->processedData = array(
            'releaseNumbers' => $this->postData['lt'],
            'productID'      => $this->postData['productID'],
            'lotteryTypeID'  => $this->postData['productID'],
        );
    }

    public function insertNavidadNumbers()
    {
        $this->processedData = array(
            'MemberId'        => $_SESSION['user_data']['MemberId'],
            'SelectedNumbers' => $this->postData['lt'],
            'productID'       => $this->postData['productID'],
            'lotteryTypeID'   => $this->postData['productID'],
            'TrackingData'    => $_SESSION['utm_campaign'],
        );
    }
}
