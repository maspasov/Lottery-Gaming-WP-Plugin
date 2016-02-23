<?php

/**
 * Created by PhpStorm.
 * User: yanislav
 * Date: 9/12/15
 * Time: 12:18 PM
 */

require 'Controllers/Controller.php';

class ResponseHandler
{
    private $postData, $action, $data;

    public function __construct($postData, $method)
    {
        $this->postData = $postData;
        $this->action   = $method;
    }

    public function handle($response)
    {
        if ($response['status'] != 200) {
            $this->data = $response['resultData'];
            $this->action = 'empty';
        } else {
            $array = json_decode($response['resultData'], true);
            if (is_array($array)) {
                $data = $array;
            } else {
                $data = $response['resultData'];
            }

            if ($this->action == 'login' || $this->action == 'signup') {
                if (isset($data['MemberId'])) {
                    // Sending Mail, If signup.
                    if ($this->action === 'signup') {
                        sendWelcomeMail($data);

                        // insert free product
                        executeGenericApiCall('playlottery/insert-member-free-product', array('MemberId' => $data['MemberId']));
                    }
                }
            }

            $this->data = $data;
        }
    }

    public function executeAction()
    {
        $controller = new Controller($this->data, $this->postData);
        $actionName = $this->action . 'Action';

        $controller->$actionName();
    }
}
