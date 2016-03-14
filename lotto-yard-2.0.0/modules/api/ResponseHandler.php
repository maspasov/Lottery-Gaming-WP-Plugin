<?php

require 'Controllers/Controller.php';
require 'ErrorHandler.php';

class ResponseHandler extends ErrorHandler
{
    private $postData, $action;

    public function __construct($postData, $method)
    {
        $this->postData = $postData;
        $this->action   = $method;
    }

    public function handle($response)
    {
        if (!$this->isResponseOkay($response)) {
            $this->action = 'error';
        }
    }

    public function executeAction()
    {
        $controller = new Controller($this->data, $this->postData);
        $actionName = $this->action . 'Action';

        $controller->$actionName();
    }
}
