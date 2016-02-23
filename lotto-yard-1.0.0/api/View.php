<?php

/**
 * Created by PhpStorm.
 * User: yanislav
 * Date: 9/11/15
 * Time: 5:05 PM
 */

class View
{
    private $data;

    public function assignData($data)
    {
        $this->data = $data;
    }

    public function render($tpl)
    {
        include get_template_directory() . '/fragments/views/' . $tpl . '.tpl.php';
    }
}