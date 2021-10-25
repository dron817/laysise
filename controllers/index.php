<?php

class Controller_Index extends Controller_Base
{

    function index()
    {
        $values['title'] = 'LAYSISE';
        if (empty($_SESSION["nick"]))
            $values['btn_lk_or_join'] = $this->registry['template']->getReplaceTemplate('btn_join');
        else
            $values['btn_lk_or_join'] = $this->registry['template']->getReplaceTemplate('btn_lk');
        $values['content'] = $this->registry['template']->getReplaceTemplate('index', $values);
        if (empty($_SESSION["nick"]))
            $values['content'] .= $this->registry['template']->getReplaceTemplate('reg-form');

        $content = $this->registry['template']->getReplaceTemplate('main', $values);
        echo $content;
    }
}