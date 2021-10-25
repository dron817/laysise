<?php

class db{

	private $mysqli;
	private $registry;
	
	public function __construct($registry) {
		$this->registry = $registry;
		$this->mysqli = new mysqli($registry['db_host'], $registry['db_username'], $registry['db_pswd'], $registry['db_name']);
		$this->mysqli->query("SET NAMES 'utf8'");
	}
	
	public function query($query){
		// echo '<br />';
		//print_r($query);
		return $this->mysqli->query($query);
	}
	
	public function select($table_name, $fields, $where = "", $order = "", $up = true, $limit = ""){
		for ($i = 0; $i < count($fields); $i++){
			if ((strpos($fields[$i], "(") === false) && ($fields[$i] != "*")) $fields[$i] = "`".$fields[$i]."`";
		}
		$fields = implode(",", $fields);
		$table_name = $this->registry['table_secret'].$table_name;
		if (!$order) $order = "ORDER BY `id`";
		else{
			if ($order != "RAND()") {
				$order = "ORDER BY `$order`";
				if (!$up) $order .= " DESC";
				}
			else $order = "ORDER BY $order";
		}
		if ($limit) $limit = "LIMIT $limit";
		if ($where) $query = "SELECT $fields FROM $table_name WHERE $where $order $limit";
		else $query = "SELECT $fields FROM $table_name $order $limit";
		$result_set = $this->query($query);
		if (!$result_set) return false;
		$i = 0;
		$data=null;
		while ($row = $result_set->fetch_assoc()) {
			$data[$i] = $row;
			$i++;
		}
		$result_set->close();
		return $data;
	}
	
	public function insert($table_name, $new_values){
		$table_name = $this->registry['table_secret'].$table_name;
		$query = "INSERT INTO $table_name (";
		foreach ($new_values as $field =>$value) $query .="`".$field."`,";
		$query = substr($query, 0, -1);
		$query .= ") VALUES (";
		foreach ($new_values as $value) $query .= "'".addslashes($value)."',";
		$query = substr($query, 0, -1);
		$query .= ")";
		return $this->query($query);
	}
	
	public function update($table_names, $upd_fields, $where){
		$table_names = $this->registry['table_secret'].$table_names;
		$query = "UPDATE $table_names SET ";
		foreach ($upd_fields as $fields => $value) $query .= "`$fields` = '".addslashes($value)."',";
		$query = substr($query, 0, -1);
		if ($where){
			$query .= " WHERE $where";
			return $this->query($query);
		}
		else return false; //������ �� ��������� ���� ������� �����
	}
	
	public function updateOnID($table_names, $id, $upd_fields){
		$table_names = $this->registry['table_secret'].$table_names;
		$query = "UPDATE $table_names SET ";
		foreach ($upd_fields as $fields => $value) $query .= "`$fields` = '".addslashes($value)."',";
		$query = substr($query, 0, -1);
		$query .= " WHERE `id`=$id";
		return $this->query($query);
	}
	
	public function delete($table_name, $where = ""){
		$table_name = $this->registry['table_secret'].$table_name;
		if ($where){
		$query = "DELETE FROM $table_name WHERE $where";
			return $this->query($query);
		}
		else return false; //������ �� �������� ���� ������� �����
	}
	
	public function clearTable($table_name) {
		$table_name = $this->registry['table_secret'].$table_name;
		$query = "TRUNCATE TABLE `$table_name`";
		return $this->query($query);
	}
	
	public function getField($table_name, $field_out, $field_in, $value_in){
		$data = $this->select($table_name, array($field_out), "`$field_in`='".addslashes($value_in)."'");
		if (count($data) != 1) return false;
		return $data[0][$field_out];
	}
	
	public function getFieldOnID($table_name, $id, $field_out){
		if (!$this->existID($table_name, $id)) return false;
		return $this->getField($table_name, $field_out, "id", $id);
	}
	
	public function getIdOnLogin($login){
		return $this->getField('users', 'id', "login", $login);
	}
	
	public function getAll($table_name, $order, $up){
		return $this->select($table_name, array("*"), "", $order, $up);
	}	
	
	public function getPage($table_name, $page, $order, $up){
		$limit=(($page-1)*$this->registry['items_on_page']).', '.($page*$this->registry['items_on_page']);
		return $this->select($table_name, array("*"), "", $order, $up, $limit);
	}
	
	public function getPageOnfield($table_name, $page, $field, $value, $order, $up){
		$limit=(($page-1)*$this->registry['items_on_page']).', '.($page*$this->registry['items_on_page']);
		return $this->select($table_name, array("*"), "`$field`='".addslashes($value)."'", $order, $up, $limit);
	}
	
	public function getAllOnfield($table_name, $field, $value, $order, $up){
		return $this->select($table_name, array("*"), "`$field`='".addslashes($value)."'", $order, $up);
	}
	
	public function getLastID($table_name){
		$data = $this->select($table_name, array("MAX(`id`)"));
		return $data[0]["MAX(`id`)"];
	}
	
	public function deleteOnField($table_name, $field, $value){
		if (!$this->isExist($table_name, $field, $value)) return false;
		return $this->delete($table_name, "`$field` = '$value'");
	}
	
	public function setField($table_name, $field, $value, $field_in, $value_in){
		return $this->update($table_name, array($field => $value), "`$field_in` = '".addslashes($value_in)."'");
	}
	
	public function setFieldOnID($table_name, $id, $field, $value){
		if (!$this->existID($table_name, $id)) return false;
		return $this->setField($table_name, $field, $value, "id", $id);
	}
	
	public function getElementOnID($table_name, $id) {
		if (!$this->existID($table_name, $id)) return false;
		$arr = $this->select($table_name, array("*"), "`id` = '$id'");
		return $arr[0];
	}
	
	public function getRandomElements($table_name, $count){
		return $this->select($table_name, array("*"), "", "RAND()", true, $count);
	}
	
	public function getCount($table_name){
		$data = $this->select($table_name, array("COUNT(`id`)"));
		return $data[0]["COUNT(`id`)"];
	}
	
	public function isExists($table_name, $field, $value){
		$data = $this->select($table_name, array("id"), "`$field` = '".addslashes($value)."'");
		if (count($data) === 0) return false;
		return true;
	}
	
	public function existID($table_name, $id){
		$data=$this->select($table_name, array("id"), "`id`='".addslashes($id)."'");
		if (count($data) === 0) return false;
		return true;
	}
	
	public function __destruct(){
		if ($this->mysqli) $this->mysqli->close();
	}
}