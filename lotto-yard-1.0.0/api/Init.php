<?php

/**
 * Created by PhpStorm.
 * User: yanislav
 * Date: 9/9/15
 * Time: 2:02 PM
 */

require 'Requester.php';
require 'ResponseHandler.php';

class Init
{
    private $postData;
    private $methodClass, $methodName;

    public function __construct($postData)
    {
        $this->postData = $postData;
    }

    public function call($method)
    {
        $this->processMethod($method);
        require 'Classes/' . $this->methodClass . '.php';

        // prepare data for request
        $class = new $this->methodClass($this->postData);
        $class->{$this->methodName}();
        $data = $class->getProcessedData();

        // do api request
        $requester = new Requester();
        $requester->sendRequest($data, $method);
        $response = $requester->getResponse();

        $handler = new ResponseHandler($this->postData, $this->methodName);
        $handler->handle($response);

        $handler->executeAction();
    }

    private function processMethod($method)
    {
        $classes = array(
            'userinfo'    => 'Users',
            'globalinfo'  => 'GlobalInfo',
            'playlottery' => 'PlayLottery',
        );
        $methodClass = 'Other';

        if (strpos($method, '/') === false) {
            $methodName = $method;
        } else {
            $names       = explode('/', $method);
            $methodClass = $classes[$names[0]];
            $methodName  = $names[1];
        }

        if (strpos($methodName, '-') !== false) {
            $words = explode('-', $methodName);

            $methodName = '';
            foreach ($words as $word) {
                $methodName .= ucfirst(strtolower($word));
            }
        }

        $this->methodName  = lcfirst($methodName);
        $this->methodClass = $methodClass;
    }
}