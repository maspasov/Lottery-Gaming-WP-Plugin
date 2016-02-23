<?php

/**
 * Created by PhpStorm.
 * User: yanislav
 * Date: 9/11/15
 * Time: 1:19 PM
 */

require dirname(__FILE__) . '/../View.php';
require dirname(__FILE__) . '/../Data/DataMapper.php';

class Controller
{
    private $view, $DM, $data, $postData;

    public function __construct($data, $postData)
    {
        $this->view     = new View();
        $this->DM       = new DataMapper($postData);
        $this->data     = $data;
        $this->postData = $postData;
    }

    public function __call($name, $arguments)
    {
        self::jsonAction();
    }

    public function jsonAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('json');
    }

    public function emptyAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('empty');
    }

    public function updatePersonalDetailsAction()
    {
        $result = executeGenericApiCall('userinfo/get-personal-details-by-memberid', array('MemberId' => $_SESSION['user_data']['MemberId']));
        $_SESSION['user_data'] = json_decode($result['response'], true);

        $this->view->assignData($this->data);
        $this->view->render('empty');
    }

    public function getPersonalDetailsByMemberidAction()
    {
        $_SESSION['user_data'] = json_decode($this->data, true);
        $this->view->render('get-personal-details-by-memberid');
    }

    public function getCreditCardMethodsByMemberidAction()
    {
        $tpl = 'get-credit-card-methods-by-memberid';
        if ($this->postData['detail'] == 1) {
            $this->data = $this->DM->getMethodDetails($this->data);
            $tpl        = 'json';
        }
        if ($this->postData['chk'] == 1) {
            $this->data = (count($this->data) > 0) ? true : false;
            $tpl        = 'json';
        }

        $this->view->assignData($this->data);
        $this->view->render($tpl);
    }

    public function updatePasswordAction()
    {
        if (is_array($this->data)) {
            $data = '{"Result":"' . $this->data[0]->ErrorMessage . '", "Valid":"' . false . '"}';
        } else {
            $decodedData = json_decode($this->data);
            $data = '{"Result":"' . $decodedData->Result . '", "Valid":"' . true . '"}';
            Login($this->postData['email'], $this->postData['password']);
        }

        $this->view->assignData($data);
        $this->view->render('json');
    }

    public function getTransactionsByMemberidAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('get-transactions-by-memberid');
    }

    public function getProductsByMemberidAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('get-products-by-memberid');
    }

    public function addUpdateCreditCardAction()
    {
        $data = json_decode($this->data);
        if (is_object($data) || is_array($data)) {
            $this->data = $data;
        }

        $this->view->assignData($this->data);
        $this->view->render('json');
    }

    public function checkmethodsAction()
    {
        $this->view->assignData(json_encode($this->data));
        $this->view->render('checkmethods');
    }

    public function insertMembersProductsWithDrawsAction()
    {
        if (isset($_SESSION['user_data']['MemberId'])) {
            $tpl = 'empty';
        } else {
            $tpl = 'json';
        }

        $this->view->assignData($this->data);
        $this->view->render($tpl);
    }

    public function insertMembersProductsWithDrawsFreeSingleLineAction()
    {
        if (isset($_SESSION['user_data']['MemberId'])) {
            $tpl = 'empty';
        } else {
            $tpl = 'json';
        }

        $this->view->assignData($this->data);
        $this->view->render($tpl);
    }

    public function getDrawsByMemberidAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('get-draws-by-memberid');
    }

    public function createPopupAction()
    {
        $_SESSION['allbrand'] = $this->data;

        $this->view->assignData($this->data);
        $this->view->render('create-popup');
    }

    public function createPopupOneAction()
    {
        $_SESSION['allresult'] = $this->data;

        $this->view->assignData($this->data);
        $this->view->render('create-popup-one');
    }

    public function breakdownForLotteryAction()
    {
        $data = $this->DM->getLotteryByDrawId($this->data);

        $this->view->assignData($data);
        $this->view->render('breakdown-for-lottery');
    }

    public function deleteCreditCardAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('delete-credit-card');
    }

    public function viewAllAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('view-all-lottery');
    }

    public function getMemberMoneyBalanceAction()
    {
        // Default Currency $
        $_SESSION['user_balance'] = json_decode($this->data, true);
        $_SESSION['user_balance']['currency'] = '$';

        $this->view->assignData($this->data);
        $this->view->render('json');
    }

    public function viewAllResultsAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('view-all-results');
    }

    public function dateWiseAction()
    {
        $data = $this->DM->getLotteryTypeId($this->data);

        $this->view->assignData($data);
        $this->view->render('date-wise');
    }

    public function chkAction()
    {
        $data = (count($this->data) > 0) ? true : false;

        $this->view->assignData($data);
        $this->view->render('empty');
    }

    public function getPersonalDetailsByEmailAction()
    {
        if (!is_array($this->data)) {
            $this->data = json_decode($this->data, true);
        }

        if (is_array($this->data)) {
            $response_reset = sendForgotPassEmail("mailservice/send-reset-password", $this->data);

            if ($response_reset['status'] == 200 && strpos($response_reset['response'], 'sent') !== false) {
                $this->data = _e('Please check your mail, We have sent your password.','twentythirteen');
            } else {
                $this->data = _e('We cannot send you the password','twentythirteen');
            }
        } else {
            $this->data = trim($this->data, '"');
        }

        $this->view->assignData($this->data);
        $this->view->render('empty');
    }

    public function getPricesAndDiscountsAction()
    {
        $_SESSION['groupdata'] = $this->data;
    }

    public function insertMembersGroupsAction()
    {
        if (isset($_SESSION['user_data']['MemberId'])) {
            $tpl = 'empty';
        } else {
            $tpl = 'json';
        }

        $this->view->assignData($this->data);
        $this->view->render($tpl);
    }

    public function getInfoAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('getinfo');
    }

    public function getDrawsTicketsByMemberidAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('get-draws-tickets-by-memberid');
    }

    public function getLotteriesLastResultsAction()
    {
        if ($this->postData['lt'] > 0) {
            $tpl        = 'date-wise';
            $this->data = $this->DM->getLotteryTypeId($this->data);
        } else {
            $tpl = 'get-lotteries-results';
        }

        $this->view->assignData($this->data);
        $this->view->render($tpl);
    }

    public function getLotteriesLastResultsPrizesAction()
    {
        if ($this->postData['drid'] > 0) {
            $this->data = $this->DM->getLotteryByDrawId($this->data);
            $tpl = 'breakdown-for-lottery';
        } else {
            $tpl = 'get-lotteries-last-results-prizes';
        }

        $this->view->assignData($this->data);
        $this->view->render($tpl);
    }

    public function quickPickSelectAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('empty');
    }

    public function ltypeAction()
    {
        $data = $this->DM->getLotteryTypeId($this->data);

        $this->view->assignData($data);
        $this->view->render('json');
    }

    public function ltypeTwoAction()
    {
        $data = $this->DM->getLotteryTypeByName($this->data);

        $this->view->assignData($data);
        $this->view->render('json');
    }

    public function getDetAction()
    {
        $data = $this->DM->getMethodDetails($this->data);

        $this->view->assignData($data);
        $this->view->render('json');
    }

    public function signupAction()
    {
        Login($this->postData['email'], $this->data['Password']);

        $this->view->assignData($this->data);
        $this->view->render('json');
    }

    public function loginAction()
    {
        Login($this->postData['email'], $this->postData['password']);

        $this->view->assignData($this->data);
        $this->view->render('json');
    }

    public function lotteryRulesAction()
    {
        $this->data = $this->DM->getLotteryTypeByName($this->data);

        $this->view->assignData($this->data);
        $this->view->render('json');
    }

    public function getNavidadNumbersAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('json');
    }

    public function insertNavidadNumbersAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('empty');
    }

    public function getAllBrandDrawsAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('json');
    }
}
