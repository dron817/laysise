<?php

require_once ('global.php');

class callback extends GlobalClass{

	public function __construct($registry){
		parent::__construct("callback", $registry);
	}
	
	public function getAllCallbacks(){	//checked
		return $this->getAll("regdate", false);
	}
	
	public function deleteCallback($id){	//checked
		return $this->delete($id);
	}
	
	public function addCallback($user){	//checked
		//if (!$this->checkValid($login, $password, $regdate)) return false;
		return $this->add($user);
	}

	public function editCallback($id, $array){	//checked
		// if (!$this->checkValid($array['login'], $array['password'], $array['date'])) return false;
		return $this->edit($id, $array);
	}
	public function getPageCallbacks($page){	//checked
		return $this->getPage($page, "date", false);
	}
	
	public function getCountCallbacks(){	//checked
		return count($this->getAll("date", false));
	}
	
	public function getCallbackByPhone($login){	//checked
		$id = $this->getField("id", "phone", $login);
		return $this->get($id);
	}	
	
	public function getCllbackOnId($id){
		return $this->get($id);
	}
}
?>