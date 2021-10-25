<?php

class Manege
{

    private $users;
    private $data;
    private $registry;

    public function __construct($registry)
    {
        $this->registry = $registry;
        $this->data = $this->secureData(array_merge($_POST, $_GET));
        $this->users = $registry['users'];
    }

    private function secureData($get)
    {
        $data[]=null;
        foreach ($get as $key => $value) {
            if (is_array($value)) $this->secureData($value);
            else $data[$key] = htmlspecialchars($value);
        }
        return $data;
    }

    public function redirect($link)
    {
        header("Location: $link");
        exit;
    }

    public function regUser()
    {
        $user['nick'] = $this->data["nick"];
        $user['email'] = $this->data["email"];
        $user['birthday'] = $this->data["birthday"];
        $user['password'] = $this->hashPassword($this->data["password"]);
        $user['date_reg'] = time();
        if (!($this->users->loginExists($user['nick'])))
            return $this->returnMessege("EXISTS_LOGIN", $this->registry['adress'] . $this->registry['reg_link']);

        $result = $this->users->addUser($user);
        if ($result) {
            //$this->registry['email']->reg($user['login'], $this->data["password"]);
            $this->login();
            return $this->returnPageMessege("SUCCRESS_REG", $this->registry['adress'] . $this->registry['lk_link']);
        } else
            return $this->unknownError($this->registry['adress'] . $this->registry['reg_link']);
    }

    public function login()
    {
        $login = $this->data["nick"];
        $password = $this->hashPassword($this->data["password"]);
        $r = $this->registry['adress'] . $this->registry['lk_link'];
        if ($this->users->checkUser($login, $password)) {
            $_SESSION["nick"] = $login;
            $_SESSION["password"] = $password;
            $_SESSION["id"] = $this->users->getIdOnLogin($login);
            $this->users->updateLastSessionTime($_SESSION["id"]);
            return $r;
        } else
            $_SESSION["error_auth"] = 1;
        return $r;
    }

    public function editUser()
    {
        $user = $this->registry['users']->getUserOnLogin($_SESSION["nick"]);

        $user['hero'] = $this->data["hero"];

        if($this->data["skill_1"]==true) $this->bookToUser($user);
        if($this->data["skill_2"]==true) $this->musicToUser($user);
        if($this->data["skill_3"]==true) $this->foodToUser($user);
        if($this->data["skill_4"]==true) $this->fitnessToUser($user);


        /*		if ($this->data['newpassword']!='')
                if ($user['password']==$this->hashPassword($this->data["oldpassword"])){
                    $user['password'] = $this->hashPassword($this->data["newpassword"]);
                }
                else{
                    $r = $this->registry['adress'].'?route=lk/profile#fast';
                    $_SESSION["error_auth"] = 1;
                    return $r;
                }
        */

        $result = $this->users->editUser($user['id'], $user);
        if ($result)
        	return $this->returnPageMessege("SUCCRESS_EDIT_USER", $this->registry['adress'].$this->registry['lk_link']);
        else
			return $this->unknownError($this->registry['adress'].$this->registry['profile_link']);
	}

    public function saveTasks()
    {
        unset($this->data['saveTasks']);
        $user = $this->registry['users']->getUserOnLogin($_SESSION["nick"]);
        $tasks=$this->registry['tasks']->getUserTasks($user['id']);
        $f['finished']=0;
        foreach ($tasks as $key=>$value){
            $this->registry['tasks']->editTask($value['id'], $f);
        }
        $_SESSION['added_EXP']=0;
        $f['finished']=1;
        $f['exp_added']=1;
        foreach ($tasks as $key=>$value){
            $reTasks[$value['id']]=$value;
        }
        if (!empty($this->data['0']))
            foreach ($this->data as $key=>$id) {
                if($reTasks[$id]['exp_added']==0)
                    $_SESSION['added_EXP']=$_SESSION['added_EXP']+$reTasks[$id]['exp_cost'];
                $this->registry['tasks']->editTask($id, $f);
            }
        $user['exp']=$user['exp']+$_SESSION['added_EXP'];
        $this->users->editUser($user['id'], $user);

        return $this->returnPageMessege("SUCCRESS_EDIT_USER", $this->registry['adress'].$this->registry['lk_link']);
	}

    private function bookToUser($user)
    {
        $task["user_id"]=$user["id"];
        $task["title"]="Читать книгу 20 минут";
        $task["exp_cost"]="30";
        $this->registry["tasks"]->addTask($task);
        $task["title"]="Выполнить 10 таблиц Шульте";
        $task["exp_cost"]="30";
        $this->registry["tasks"]->addTask($task);
    }
    private function musicToUser($user)
    {
        $task["user_id"]=$user["id"];
        $task["title"]="Разучить бой восьмёрка";
        $task["exp_cost"]="30";
        $this->registry["tasks"]->addTask($task);
        $task["title"]="Играть гаммы";
        $task["exp_cost"]="30";
        $this->registry["tasks"]->addTask($task);
    }
    private function foodToUser($user)
    {
        $task["user_id"]=$user["id"];
        $task["title"]="Съесть кашу на завтрак";
        $task["exp_cost"]="30";
        $this->registry["tasks"]->addTask($task);
        $task["title"]="Съесть 3 яблока в течении дня";
        $task["exp_cost"]="30";
        $this->registry["tasks"]->addTask($task);
    }
    private function fitnessToUser($user)
    {
        $task["user_id"]=$user["id"];
        $task["title"]="Сделать утреннюю зарядку";
        $task["exp_cost"]="30";
        $this->registry["tasks"]->addTask($task);
        $task["title"]="Пробежать 1 километр";
        $task["exp_cost"]="30";
        $this->registry["tasks"]->addTask($task);
    }

    public function forgetpass()
    {
        if (!($this->users->loginExists($this->data["login"]))) {
            $user = $this->registry['users']->getUserOnLogin($this->data["login"]);
            if ($user['phone'] == $this->data["phone"]) {
                $password = $this->users->getRandomPass();
                $user['password'] = $this->hashPassword($password);
                $result = $this->users->editUser($user['id'], $user);
                if ($result) {
                    echo $this->registry['email']->newPass($user['login'], $password);
                    return $this->returnPageMessege("SUCCRESS_NEWPASS", $this->registry['adress'] . $this->registry['msg_link']);
                } else
                    return $this->unknownError($this->registry['adress'] . $this->registry['profile_link']);
            }
        }
        $r = $this->registry['adress'] . '?route=forgetpass';
        $_SESSION["error_forgetpass"] = 1;
        return $r;

    }

    public function logout()
    {
        unset($_SESSION["nick"]);
        unset($_SESSION["password"]);
        unset($_SESSION["id"]);
        return $this->registry['adress'];
    }

    public function deleteUser($id)
    {
        if ($this->users->getUserOnId($_SESSION["id"])['power_group'] != 2) return '/';
        $this->users->deleteUser($id);
        return "?route=lk/users#fast";//исправить при переносе на сервер
    }

    private function hashPassword($password)
    {
        return md5($password . $this->registry['pswd_secret']);
    }

    private function unknownError($r)
    {
        return $this->returnMessege("UNKNOWN_ERROR", $r);
    }

    private function returnMessege($messege, $r)
    {
        $_SESSION["messege"] = $messege;
        return $r;
    }

    private function returnPageMessege($messege, $r)
    {
        $_SESSION["page_messege"] = $messege;
        return $r;
    }

}