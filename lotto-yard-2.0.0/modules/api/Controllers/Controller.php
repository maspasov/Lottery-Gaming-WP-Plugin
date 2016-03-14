<?php

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
        Login($_SESSION['user_data']['Email'], $_SESSION['user_data']['Password']);

        $this->view->assignData($this->data);
        $this->view->render('json');
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

        $this->view->assignData($this->data);
        $this->view->render($tpl);
    }

    public function updatePasswordAction()
    {
        Login($this->postData['email'], $this->postData['password']);

        $this->view->assignData($this->data);
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
        $this->view->render('empty');
    }

    public function viewAllAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('view-all-lottery');
    }

    public function getMemberMoneyBalanceAction()
    {
        // Default Currency
        $_SESSION['user_balance'] = $this->data;
        $_SESSION['user_balance']['currency'] = SITE_CURRENCY;

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

    public function getPersonalDetailsByEmailAction()
    {
        if (is_array($this->data)) {
            $response_reset = sendForgotPassEmail("mailservice/send-reset-password", $this->data);

            if ($response_reset['status'] == 200 && strpos($response_reset['response'], 'sent') !== false) {
                $this->data = array('msg' => __('Please check your mail, We have sent your password.', 'twentythirteen'));
            } else {
                $this->data = array('msg' => __('We cannot send you the password', 'twentythirteen'));
            }
        }

        $this->view->assignData($this->data);
        $this->view->render('json');
    }

    public function getPricesAndDiscountsAction()
    {
        $_SESSION['groupdata'] = $this->data;
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
        $this->data = $this->DM->getLotteryByDrawId($this->data);

        $this->view->assignData($this->data);
        $this->view->render('breakdown-for-lottery');
    }

    public function quickPickSelectAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('json');
    }

    public function ltypeAction()
    {
        $data = $this->DM->getLotteryTypeId($this->data);

        $this->view->assignData($data);
        $this->view->render('json');
    }

    public function lotteryRulesAction()
    {
        $data = $this->DM->getLotteryTypeByName($this->data);

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

        if (isset($_SESSION['user_data'])) {
            // welcome mail
            sendWelcomeMail();

            // insert free product
            executeGenericApiCall('playlottery/insert-member-free-product', array('MemberId' => $_SESSION['user_data']['MemberId']));
        }

        $tpl = (is_array($this->data)) ? 'json' : 'empty';

        $this->view->assignData($this->data);
        $this->view->render($tpl);
    }

    public function loginAction()
    {
        Login($this->postData['email'], $this->postData['password']);

        $tpl = (is_array($this->data)) ? 'json' : 'empty';

        $this->view->assignData($this->data);
        $this->view->render($tpl);
    }

    public function insertNavidadNumbersAction()
    {
        $this->view->assignData($this->data);
        $this->view->render('empty');
    }
}
