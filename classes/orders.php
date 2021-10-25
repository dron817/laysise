<?php

require_once ('global.php');

class Orders extends GlobalClass{

	public function __construct($registry){
		parent::__construct("orders", $registry);
	}
	
	public function getAllOrders(){	//checked
		return $this->getAll("orderdate", false);
	}
	
	public function getPageOrders($page){	//checked
		return $this->getPage($page, "orderdate", false);
	}
	
	public function getPageOrdersByUser($id, $page){	//checked
		return $this->getPageOnField($page, 'autor', $id, "orderdate");
		return $this->getPage($page, "orderdate", false);
	}
	
	public function getPageOrdersByCourier($id, $page){	//checked
		return $this->getPageOnField($page, 'courier', $id, "orderdate");
		return $this->getPage($page, "orderdate", false);
	}
	
	public function deleteOrder($id){	//checked
		return $this->delete($id);
	}
	
	public function addOrder($Order){	//checked
		//if (!$this->checkValid($login, $password, $regdate)) return false;
		return $this->add($Order);
	}

	public function editOrder($id, $array){	//checked
		// if (!$this->checkValid($array['login'], $array['password'], $array['date'])) return false;
		return $this->edit($id, $array);
	}
	
	public function getOrderOnId($id){
		return $this->get($id);
	}
	
	private function checkValid($login, $password, $date){	//checked
		if (!$this->valid->validLogin($login)) return false;
		if (!$this->loginExists($login)) return false;
	//	if (!$this->valid->validHash($password)) return false;
		if (!$this->valid->validTimeStamp($date)) return false;
		return true;
	}
	
	public function getOrdersByUser($id){
		return $this->getAllOnField('autor', $id, "receiptdate");
	}
	
	public function getOrdersByCourier($id){
		return $this->getAllOnField('courier', $id, "receiptdate");
	}
		
	public function getCountOrders(){
		return count($this->getAll("receiptdate", false));
	}
	
	public function getCountOrdersByUser($id){
		return count($this->getOrdersByUser($id));
	}
	
	public function getCountOrdersByCourier($id){
		return count($this->getOrdersByCourier($id));
	}
}
?>