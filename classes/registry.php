<?php

Class Registry Implements ArrayAccess {
    private $vars = array();
	
	public function __construct() {
		$this->vars['db_host'] = "a237567.mysql.mchost.ru";
		$this->vars['db_username'] = "a237567_ls";
		$this->vars['db_pswd'] = "f4ed43a3";
		$this->vars['db_name'] = "a237567_laysise";
		$this->vars['pswd_secret'] = "_lse";
		$this->vars['table_secret'] = "lse_";
		$this->vars['adress'] = "/";
		$this->vars['logout_link'] = "index.php?logout=1";
		$this->vars['reg_link'] = "index.php?route=reg";
		$this->vars['msg_link'] = "index.php?route=msg";
		$this->vars['order_link'] = "index.php?route=order";
		$this->vars['profile_link'] = "index.php?route=lk/profile#fast";
		$this->vars['lk_link'] = "index.php?route=lk";
		$this->vars['items_on_page'] = 20;
		$this->vars['admin_mail'] = 'webmaster@89cargotaxi.ru';
	}
	
	function offsetExists($offset) {
			return isset($this->vars[$offset]);
	}

	function offsetGet($offset) {
			return $this->get($offset);
	}

	function offsetSet($offset, $value) {
			$this->set($offset, $value);
	}

	function offsetUnset($offset) {
			unset($this->vars[$offset]);
	}

	function set($key, $var) {
			if (isset($this->vars[$key]) == true) {
					throw new Exception('Unable to set var `' . $key . '`. Already set.');
			}
			$this->vars[$key] = $var;
			return true;
	}

	function get($key) {
			if (isset($this->vars[$key]) == false) {
					return null;
			}
			return $this->vars[$key];
	}

	function remove($var) {
			unset($this->vars[$key]);
	}
}


?>