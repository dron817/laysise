<?php

class Controller_NewYear extends Controller_Base
{

    function index()
    {
        $values['title'] = 'New Year';
        if (empty($_SESSION["newyear"]))
            $values['content'] = $this->registry['template']->getReplaceTemplate('newyear_form');
        else{
            $values['fio'] = $_SESSION["fio"];
            $values['please'] = $_SESSION["please"];
            //session_destroy();
            $values['content'] = $this->registry['template']->getReplaceTemplate('newyear_res', $values);
        }
        $content = $this->registry['template']->getReplaceTemplate('newyear_main', $values);
        echo $content;
    }
}