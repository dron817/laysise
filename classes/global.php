<?php

abstract class GlobalClass{
	
	private $db;
	private $table_name;
	protected $registry;
	
	protected function __construct($table_name, $registry){
		$this->db = $registry['db'];
		$this->registry = $registry;
		$this->table_name = $table_name;
	}

	protected function getElementOnID($id){
		return $this->db->getElementOnID($this->table_name, $id);
	}
	
	protected function add($new_values){
		return $this->db->insert($this->table_name, $new_values);
	}
	
	protected function edit($id, $upd_fields){
		return $this->db->updateOnID($this->table_name, $id, $upd_fields);
	}
	
	public function delete($id){
		return $this->deleteOnID($id);
	}
	
	public function deleteOnID($id){
		if (!$this->db->existID($this->table_name, $id)) return false;
		return $this->deleteOnField('id', $id);
	}
	
	public function deleteOnField($field, $value){
		return $this->db->delete($this->table_name, "`$field` = '$value'");
	}
	
	public function clearTable(){
		return $this->db->clearTable($this->table_name);
	}
		
	protected function getField($field_out, $field_in, $value_in){
		return $this->db->getField($this->table_name, $field_out, $field_in, $value_in);
	}
	
	protected function getFieldOnID($id, $field){
		return $this->db->getFieldOnID($this->table_name, $id, $field);
	}
	
	protected function setFieldOnID($id, $field, $value){
		return $this->db->setFieldOnID($this->table_name, $id, $field, $value);
	}
	
	public function get($id){
		return $this->db->getElementOnID($this->table_name, $id);
	}
	
	public function getAllOnUserId($id){
		return $this->getAllOnField("user", $id, "date", false);
	}	
	
	public function getAllOnToUserId($id){
		return $this->getAllOnField("user_to", $id, "date", false);
	}
	
	public function isAdmin($id){
		//foreach ($this->config->admin_list as $key=>$value){
		//	if ($_SESSION['id']==$value) return true;
		//}
		return false;
	}
	
	public function convertDate($date){
		date_default_timezone_set('Etc/GMT-6');
		if (date('d', time()) == date('d', $date)) $text = "Сегодня ";
		elseif (date('d', time())-1 == date('d', $date)) $text = "Вчера ";
		else {
			$mouth =date('n', $date);
			switch ($mouth){
				case "1": $mouth = "Января"; break;
				case "2": $mouth = "Февраля"; break;
				case "3": $mouth = "Марта"; break;
				case "4": $mouth = "Апреля"; break;
				case "5": $mouth = "Мая"; break;
				case "6": $mouth = "Июня"; break;
				case "7": $mouth = "Июля"; break;
				case "8": $mouth = "Августа"; break;
				case "9": $mouth = "Сентября"; break;
				case "10": $mouth = "Октября"; break;
				case "11": $mouth = "Ноября"; break;
				case "12": $mouth = "Декабря"; break;
			}
			$text .= date('j', $date)." ".$mouth." ";
			if (!(date('Y', $date) == date('Y', time()))) $text .= date('Y	', $date);
		}
		$text .=date('G:i', $date);
		return $text;
	}
	
	public function getAll($order = "", $up = true){
		return $this->db->getAll($this->table_name, $order, $up);
	}
	
	public function getPage($page, $order = "", $up = true){
		return $this->db->getPage($this->table_name, $page, $order, $up);
	}
	
	public function getPageOnField($page, $field, $value, $order = "date", $up = false){
		return $this->db->getPageOnfield($this->table_name, $page, $field, $value, $order, $up);
	}
	
	protected function getAllOnField($field, $value, $order = "date", $up = false){
		return $this->db->getAllOnfield($this->table_name, $field, $value, $order, $up);
	}
	
	public function getRandomElements ($n){
		return $this->db->getRandomElements($this->table_name, $n);
	}
	
	public function getLastID(){
		return $this->db->getLastID($this->table_name);
	}

	public function getCount(){
		return $this->db->getCount($this->table_name);
	}
	
	public function isExists($field, $value){
		return !$this->db->isExists($this->table_name, $field, $value);
	}
}
?>