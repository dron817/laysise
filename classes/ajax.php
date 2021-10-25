<?php


require_once ('registry.php');
require_once('db.php');
# Создаём регистратуру
$registry = new Registry;
# Соединяемся с БД
$db = new db($registry);
$registry->set ('db', $db);

switch ($_POST['action']){

        case "showRegionForInsert":
                echo '<select name="region" onchange="selectCity();" required="required"><option selected disabled value="">Выбор региона</option>';
				$table_name= "regions";
				$field= "country_id";
				$value= $_POST['id_country'];
				$order = "region";
				$up = true;
				$rows = $db->getAllOnfield($table_name, $field, $value, $order, $up);
                foreach ($rows as $numRow => $row) {
                    echo '<option value="'.$row['id'].'">'.$row['region'].'</option>';
                };
                echo '</select>';
                break;
                
        case "showCityForInsert":
                echo '<option selected disabled value="">Выбор города</option>';
				$table_name= "cities";
				$field= "id_region";
				$value= $_POST['id_region'];
				$order = "city";
				$up = true;
				$rows = $db->getAllOnfield($table_name, $field, $value, $order, $up);
                foreach ($rows as $numRow => $row) {
                    echo '<option value="'.$row['id'].'">'.$row['city']." (".$row['state'].")</option>";
                };
                echo '</select>';
                break;
				
        case "showCalc":
				$A['c05']=350;
				$A['c1']=400;
				$A['cplus']=110;
				$E['c05']=550;
				$E['c1']=600;
				$E['cplus']=220;
				$m=$_POST['weight'];
				$K=($_POST['city1'] == 15714)?$A:$E;
				if ($m<=0.5) $count=3*$K['c05'];
				else if ($m<=1) $count=3.1*$K['c1'];
				else if ($m>1) $count=2*$K['c1']+2*($m-1)*$K['cplus'];
				
				$count=round($count, -2);
                echo "Предварительная стоимость доставки $count р."."<input value= $count type='hidden' name='price'/>";;
                break;
				
        case "getIndex":
				$table_name= "cities";
				$field= "id";
				$value= $_POST['id_city'];
				$order = "city";
				$up = true;
				$rows = $db->getAllOnfield($table_name, $field, $value, $order, $up);
				$city =$rows['0']['city'];
				$link = 'http://post-api.ru/api/v2/ibc.php?c='.$city.'&s=ленина&apikey=pdzvemgpibvn8s7g';
				$json = json_decode(file_get_contents($link), true);
				if (empty($json['content']['0']['indexes']['0'])) break; 
				echo($json['content']['0']['indexes']['0']);
                break;
				
        case "selectStatus":
				$table_name= "orders";
				$id = $_POST['id'];
				$upd_fields['status']= $_POST['status'];
				$db->updateOnID($table_name, $id, $upd_fields);	
                break;
				
        case "selectCourier":
				$table_name= "orders";
				$id = $_POST['id'];
				$upd_fields['courier']= $_POST['courier'];
				$db->updateOnID($table_name, $id, $upd_fields);	
                break;
				
        case "inputPrice":
			$table_name= "orders";
			$id = $_POST['id'];
			$upd_fields['payed'] = $_POST['price'];
			$db->updateOnID($table_name, $id, $upd_fields);	
			break;
			
        case "selectPowerGroup":
			$table_name= "users";
			$id = $_POST['id'];
			$upd_fields['power_group']=$_POST['PowerGroup'];
			$db->updateOnID($table_name, $id, $upd_fields);
			break;
			
        case "selectCallbackStatus":
			$table_name= "callback";
			$id = $_POST['id'];
			$upd_fields['status']=$_POST['Status'];
			$db->updateOnID($table_name, $id, $upd_fields);
			break;
			
        case "refreshAdminSound":
			$text='';
			$orders = count($db->getAll('orders',"receiptdate", false))-$_POST['countOrders'];
			$callbacks = count($db->getAll('callback',"date", false))-$_POST['countCallbacks'];
			if ($orders>0)
				for ($i = 0; $i < $orders; $i++)
					$text .='<a href="?route=lk#fast" target="_self"><strong id="new"><div class="notification">Новый заказ!</div></strong></a><audio autoplay src="ringtone.mp3"></audio>';
				for ($i = 0; $i < $callbacks; $i++)
					$text .='<a href="?route=lk/callbacks#fast" target="_self"><strong id="new"><div class="notification">Заявка на звонок!</div></strong></a><audio autoplay src="ringtone.mp3"></audio>';
			echo $text;
			break;
			
        case "refreshAdminNoSound":
			$text='';
			$orders = count($db->getAll('orders',"receiptdate", false))-$_POST['countOrders'];
			$callbacks = count($db->getAll('callback',"date", false))-$_POST['countCallbacks'];
			if ($orders>0)
				for ($i = 0; $i < $orders; $i++)
					$text .='<a href="?route=lk#fast" target="_self"><strong id="new"><div class="notification">Новый заказ!</div></strong></a>';
			if ($callbacks>0)
				for ($i = 0; $i < $callbacks; $i++)
					$text .='<a href="?route=lk/callbacks#fast" target="_self"><strong id="new"><div class="notification">Заявка на звонок!</div></strong></a>';
			echo $text;
			break;
			
        case "refreshCourierSound":
			$text='';
			$deb = count($db->getAllOnfield("orders", "courier", $_POST['id'], "receiptdate", false))-$_POST['countOrders'];
			
			if ($deb>0)
			{	
				for ($i = 0; $i < $deb; $i++)
				$text .='<a href="?route=lk" target="_blank"><strong id="new"><div class="notification">Назначен новый заказ!</div></strong></a><audio autoplay src="ringtone.mp3"></audio>';
			}
				echo $text;
			break;
			
        case "refreshCourierNoSound":
			$text='';
			$deb = count($db->getAllOnfield("orders", "courier", $_POST['id'], "receiptdate", false))-$_POST['countOrders'];
			
			if ($deb>0)
			{	
				for ($i = 0; $i < $deb; $i++)
				$text .='<a href="?route=lk" blank><strong id="new"><div class="notification">Назначен новый заказ!</div></strong></a>';
			}
				echo $text;
			break;
};

?>