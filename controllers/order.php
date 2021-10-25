<?php
Class Controller_order Extends Controller_Base {
	
        function index($type='econom') {
			$values['refreshscript']=$this->getNotificationScript();
			if (empty($_SESSION["login"])) $_SESSION["login"]=0; //иниализация от ошибки запроса логина пользоватяля, когда он не зарегистрирован
			if ($this->registry['users']->getUserOnLogin($_SESSION["login"])['power_group']>0){
				$msg['banner'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
				$msg['mesage'] = 'Используйте пользовательский аккаунт для создания заказов';
				$values['content'] = $this->registry['template']->getReplaceTemplate('msg', $msg);
				$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
				$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
				$values['content'] .= $this->registry['template']->getReplaceTemplate('statusblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
				echo $content;
				break;
			}
			else{
				$values['scripts'] = $this->registry['template']->getReplaceTemplate('ajax');
					$values['content'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
				switch ($type){
						case "express": $autoload['sel_express']='selected'; break;
						case "econom": $autoload['sel_econom']='selected'; break;	
						case "assembled": $autoload['sel_assembled']='selected'; break;
				};
					$autoload['email']='';
					$autoload['FIO']='';
					$autoload['phone']='';
					$autoload['second_phone']='';
					$autoload['organization']='';
					$autoload['o_adress']='';
					$autoload['index']='';
					
					$autoload['counries_options']='';
					$table_name= "countries";
					$order = "id";
					$up = true;
					$rows = $this->registry['db']->getAll($table_name, $order, $up);
					foreach ($rows as $numRow => $row) {
						$autoload['counries_options'] .= "<option value='".$row['id']."'>".$row['name']."</option>";
					};
					
				if (!empty($_SESSION["id"])){					
					$user = $this->registry['users']->getUserOnId($_SESSION["id"]);
					$autoload['email']=$user['login'];
					$autoload['FIO']=$user['FIO'];
					$autoload['phone']=$user['phone'];
					$autoload['second_phone']=$user['second_phone'];
					$autoload['organization']=$user['organization'];
					$autoload['o_adress']=$user['adress'];
					$autoload['index']=$user['index'];
					
					$autoload['counries_options']='';
					$table_name= "countries";
					$order = "id";
					$up = true;
					$rows = $this->registry['db']->getAll($table_name, $order, $up);
					foreach ($rows as $numRow => $row) {
						$selected =($user['country']==$row['id'])?'selected':'';
						$autoload['counries_options'] .= "<option $selected value='".$row['id']."'>".$row['name']."</option>";
					};
					
					$autoload['regions_options']='';
					$table_name= "regions";
					$field = "country_id";
					$value = $user['country'];
					$order = "region";
					$up = true;
					$rows = $this->registry['db']->getAllOnfield($table_name, $field, $value, $order, $up);
					foreach ($rows as $numRow => $row) {
						$selected =($user['region']==$row['id'])?'selected':'';
						$autoload['regions_options'] .= "<option $selected value='".$row['id']."'>".$row['region']."</option>";
					};
					
					$autoload['cities_options']='';
					$table_name= "cities";
					$field = "id_region";
					$value = $user['region'];
					$order = "city";
					$up = true;
					$rows = $this->registry['db']->getAllOnfield($table_name, $field, $value, $order, $up);
					foreach ($rows as $numRow => $row) {
						$selected =($user['city']==$row['id'])?'selected':'';
						$autoload['cities_options'] .= "<option $selected value='".$row['id']."'>".$row['city']." (".$row['state'].")</option>";
					};
				}
					$autoload['err_msg']=isset($_SESSION['no_capcha'])?'Подтвердите, что вы не робот':'';
					unset($_SESSION['no_capcha']);
					$values['content'] .= $this->registry['template']->getReplaceTemplate('order-form', $autoload);;
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
				echo $content;
			}
        }
        function express() {
			$this->index('express');
        }
        function econom() {
			$this->index('econom');
        }
        function assembled() {
			$this->index('assembled');
        }
		
        function calc($type='econom') {
			$values['refreshscript']=$this->getNotificationScript();
			if (empty($_SESSION["login"])) $_SESSION["login"]=0; //иниализация от ошибки запроса логина пользоватяля, когда он не зарегистрирован
			{
				$values['scripts'] = $this->registry['template']->getReplaceTemplate('ajax');
					$values['content'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
					switch ($type){
							case "express": $autoload['sel_express']='selected'; break;
							case "econom": $autoload['sel_econom']='selected'; break;	
							case "assembled": $autoload['sel_assembled']='selected'; break;
					};
					$autoload['index']='';
					$autoload['counries_options']='';
					$table_name= "countries";
					$order = "id";
					$up = true;
					$rows = $this->registry['db']->getAll($table_name, $order, $up);
					foreach ($rows as $numRow => $row) {
						$autoload['counries_options'] .= "<option value='".$row['id']."'>".$row['name']."</option>";
					};
					
				if (!empty($_SESSION["id"])){					
					$user = $this->registry['users']->getUserOnId($_SESSION["id"]);
					$autoload['o_adress']=$user['adress'];
					$autoload['index']=$user['index'];
					
					$autoload['counries_options']='';
					$table_name= "countries";
					$order = "id";
					$up = true;
					$rows = $this->registry['db']->getAll($table_name, $order, $up);
					foreach ($rows as $numRow => $row) {
						$selected =($user['country']==$row['id'])?'selected':'';
						$autoload['counries_options'] .= "<option $selected value='".$row['id']."'>".$row['name']."</option>";
					};
					
					$autoload['regions_options']='';
					$table_name= "regions";
					$field = "country_id";
					$value = $user['country'];
					$order = "region";
					$up = true;
					$rows = $this->registry['db']->getAllOnfield($table_name, $field, $value, $order, $up);
					foreach ($rows as $numRow => $row) {
						$selected =($user['region']==$row['id'])?'selected':'';
						$autoload['regions_options'] .= "<option $selected value='".$row['id']."'>".$row['region']."</option>";
					};
					
					$autoload['cities_options']='';
					$table_name= "cities";
					$field = "id_region";
					$value = $user['region'];
					$order = "city";
					$up = true;
					$rows = $this->registry['db']->getAllOnfield($table_name, $field, $value, $order, $up);
					foreach ($rows as $numRow => $row) {
						$selected =($user['city']==$row['id'])?'selected':'';
						$autoload['cities_options'] .= "<option $selected value='".$row['id']."'>".$row['city']." (".$row['state'].")</option>";
					};
				}
					$values['content'] .= $this->registry['template']->getReplaceTemplate('calc-form', $autoload);
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
				echo $content;
			}
        }
}
?>