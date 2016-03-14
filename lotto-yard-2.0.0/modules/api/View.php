<?php

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
