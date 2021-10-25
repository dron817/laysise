<?php

require_once ('global.php');

class Tasks extends GlobalClass{

    public function __construct($registry){
        parent::__construct("tasks", $registry);
    }

    public function getUserTasks($id){	//checked
        return $this->getAllOnField('user_id', $id, "id");
    }

    public function deleteTask($id){	//checked
        return $this->delete($id);
    }

    public function addTask($task){	//checked
        //if (!$this->checkValid($login, $password, $regdate)) return false;
        return $this->add($task);
    }

    public function editTask($id, $array){	//checked
        // if (!$this->checkValid($array['login'], $array['password'], $array['date'])) return false;
        return $this->edit($id, $array);
    }

}