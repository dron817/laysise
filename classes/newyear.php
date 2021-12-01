<?php

require_once ('global.php');

class NewYear extends GlobalClass{

    public function __construct($registry){
        parent::__construct("newyear", $registry);
    }

    public function getNYOnId($id){
        return $this->get($id);
    }

    public function deleteNY($id){	//checked
        return $this->delete($id);
    }

    public function addNY($task){	//checked
        //if (!$this->checkValid($login, $password, $regdate)) return false;
        return $this->add($task);
    }

    public function editNY($id, $array){	//checked
        // if (!$this->checkValid($array['login'], $array['password'], $array['date'])) return false;
        return $this->edit($id, $array);
    }

}