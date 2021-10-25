<?php

class Controller_lk extends Controller_Base
{

    function page($args = 1)
    {
        $this->index($args);
    }

    function index($args = 1)
    {
        if (!empty($_SESSION["nick"])) {
            //пользователь
            $res = [];
            $values = [];
            $values['title']="Личный кабинет - LAYSISE";
            $values['logout_link']=$this->registry['adress'].$this->registry['logout_link'];
            //свежий аккаунт
            if ($this->registry['users']->isNoob($_SESSION['id'])){
                $values['content'] = $this->registry['template']->getReplaceTemplate('lk_setup', $res);
            }
            //рабочий аккаунт
            else{
                $user=$this->registry['users']->getUserOnId($_SESSION['id']);
                $res['nick']=$user['nick'];
                $res['hero_id']=$user['hero'];
                //доступно: 0-15-30-45-60-75-90-95
                $res['lvl']='';
                $res['exp']='';
                list($res['lvl'], $res['exp']) = explode('.', $user['exp'] / 100);
                $res['lvl']=$res['lvl']+1;
                $res['exp']=$res['exp']*10;
                if ($res['exp']>=0&&$res['exp']<8)
                    $res['percent']="0";
                if ($res['exp']>=8&&$res['exp']<22)
                    $res['percent']="15";
                if ($res['exp']>=22&&$res['exp']<38)
                    $res['percent']="30";
                if ($res['exp']>=38&&$res['exp']<52)
                    $res['percent']="45";
                if ($res['exp']>=52&&$res['exp']<68)
                    $res['percent']="60";
                if ($res['exp']>=68&&$res['exp']<82)
                    $res['percent']="75";
                if ($res['exp']>=82&&$res['exp']<92)
                    $res['percent']="90";
                if ($res['exp']>=92&&$res['exp']<100)
                    $res['percent']="95";

                $tasks=$this->registry['tasks']->getUserTasks($_SESSION['id']);
                $res['tasks']=null;
                foreach ($tasks as $key => $value){
                    $taskInner['id_task']=$value['id'];
                    $taskInner['title_task']=$value['title'];
                    $taskInner['task_exp']=$value['exp_cost'];
                    $taskInner['checked']=$value['finished']=="1"?"checked":"";
                    $res['tasks'].=$this->registry['template']->getReplaceTemplate('task', $taskInner);
                }
                $values['content'] = $this->registry['template']->getReplaceTemplate('lk', $res);
            }
        } else {
            if (!empty($_SESSION['error_auth'])) {
                $values['message'] = $this->registry['template']->getReplaceTemplate('error_auth');
                unset($_SESSION['error_auth']);
            } else
                $values['message'] = '';
                $values['title'] = 'Авторизация - LaySise';
                $values['content'] = $this->registry['template']->getReplaceTemplate('auth-form', $values);
        }
        $content = $this->registry['template']->getReplaceTemplate('main', $values);
        echo $content;
    }

    function profile()
    {
        $values=[];
        if (!empty($_SESSION["login"])) {
            if (!empty($_SESSION['error_auth'])) {
                $values['message'] = $this->registry['template']->getReplaceTemplate('error_edit_user');
                unset($_SESSION['error_auth']);
            } else
                $values['message'] = '';

            $profile = $this->registry['users']->getUserOnLogin($_SESSION["login"]);
            $val['FIO'] = $profile['FIO'];
            $val['phone'] = $profile['phone'];
            $values['content'] .= $this->registry['template']->getReplaceTemplate('profile', $val);
        } else {
            $values['content'] .= $this->registry['template']->getReplaceTemplate('auth-form', $values);
        }
        $content = $this->registry['template']->getReplaceTemplate('main', $values);
        echo $content;
    }
}