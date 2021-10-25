<?php
class email {

  private $from;
  private $from_name = "";
  private $type = "text/html";
  private $encoding = "utf-8";
  private $notify = false;
  private $registry;

  /* Конструктор принимающий обратный e-mail адрес */
  public function __construct($registry, $from) {
    $this->from = $from;
    $this->registry = $registry;
  }

  /* Изменение обратного e-mail адреса */
  public function setFrom($from) {
    $this->from = $from;
  }

  /* Изменение имени в обратном адресе */
  public function setFromName($from_name) {
    $this->from_name = $from_name;
  }

  /* Изменение типа содержимого письма */
  public function setType($type) {
    $this->type = $type;
  }

  /* Нужно ли запрашивать подтверждение письма */
  public function setNotify($notify) {
    $this->notify = $notify;
  }

  /* Изменение кодировки письма */
  public function setEncoding($encoding) {
    $this->encoding = $encoding;
  }

  /* Метод отправки письма */
  private function send($to, $subject, $message) {
    $from = "=?utf-8?B?".base64_encode($this->from_name)."?="." <".$this->from.">"; // Кодируем обратный адрес (во избежание проблем с кодировкой)
    $headers = "From: ".$from."\r\nReply-To: ".$from."\r\nContent-type: ".$this->type."; charset=".$this->encoding."\r\n"; // Устанавливаем необходимые заголовки письма
    if ($this->notify) $headers .= "Disposition-Notification-To: ".$this->from."\r\n"; // Добавляем запрос подтверждения получения письма, если требуется
    $subject = "=?utf-8?B?".base64_encode($subject)."?="; // Кодируем тему (во избежание проблем с кодировкой)
    mail($to, $subject, $message, $headers); // Отправляем письмо и возвращаем результат
    return mail($this->registry['admin_mail'], $subject, $message, $headers); // Отправляем копию администатору
  }
  
  public function order($to, $id, $order){
	$subject = "CargoTaxi - заказ №$id";
	$orderinfo['n'] = $id;
	$orderinfo['type'] = $this->typeConvert($order['type']);
	$orderinfo['orderdate'] = date('d.m.Y',$order['orderdate']).'г.';
	$orderinfo['places'] = $order['places'];
	$orderinfo['description'] = $order['description'];
	$orderinfo['weight'] = $order['weight'];
	$orderinfo['email'] = $order['email'];
	$orderinfo['FIO'] = $order['FIO'];
	$orderinfo['phone'] = $order['phone'];
	$orderinfo['second_phone'] = $order['second_phone'];
	$orderinfo['organization'] = $order['organization'];
	$orderinfo['country'] = $this->registry['db']->getFieldOnID('countries', $order['country'], 'name');
	$orderinfo['region'] = $this->registry['db']->getFieldOnID('regions', $order['region'], 'region');
	$orderinfo['city'] = $this->registry['db']->getFieldOnID('cities', $order['city'], 'city');
	$orderinfo['orderadress'] = $order['adress'];
	$orderinfo['index'] = $order['index'];
	$orderinfo['note'] = $order['note'];
	$orderinfo['email2'] = $order['email2'];
	$orderinfo['FIO2'] = $order['FIO2'];
	$orderinfo['phone2'] = $order['phone2'];
	$orderinfo['second_phone2'] = $order['second_phone2'];
	$orderinfo['organization2'] = $order['organization2'];
	$orderinfo['country2'] = $this->registry['db']->getFieldOnID('countries', $order['country2'], 'name');
	$orderinfo['region2'] = $this->registry['db']->getFieldOnID('regions', $order['region2'], 'region');
	$orderinfo['city2'] = $this->registry['db']->getFieldOnID('cities', $order['city2'], 'city');
	$orderinfo['orderadress2'] = $order['adress2'];
	$orderinfo['index2'] = $order['index2'];
	$orderinfo['note2'] = $order['note2'];
	$message = $this->registry['template']->getReplaceTemplate('email_order', $orderinfo);
	return $this->send($to, $subject, $message);
}  

  public function orderReg($to, $pass, $id, $order){
	$subject = "CargoTaxi - заказ №$id";
	$orderinfo['pass'] = $pass;
	$orderinfo['n'] = $id;
	$orderinfo['type'] = $this->typeConvert($order['type']);
	$orderinfo['orderdate'] = date('d.m.Y',$order['orderdate']).'г.';
	$orderinfo['places'] = $order['places'];
	$orderinfo['description'] = $order['description'];
	$orderinfo['weight'] = $order['weight'];
	$orderinfo['email'] = $order['email'];
	$orderinfo['FIO'] = $order['FIO'];
	$orderinfo['phone'] = $order['phone'];
	$orderinfo['second_phone'] = $order['second_phone'];
	$orderinfo['organization'] = $order['organization'];
	$orderinfo['country'] = $this->registry['db']->getFieldOnID('countries', $order['country'], 'name');
	$orderinfo['region'] = $this->registry['db']->getFieldOnID('regions', $order['region'], 'region');
	$orderinfo['city'] = $this->registry['db']->getFieldOnID('cities', $order['city'], 'city');
	$orderinfo['orderadress'] = $order['adress'];
	$orderinfo['index'] = $order['index'];
	$orderinfo['note'] = $order['note'];
	$orderinfo['email2'] = $order['email2'];
	$orderinfo['FIO2'] = $order['FIO2'];
	$orderinfo['phone2'] = $order['phone2'];
	$orderinfo['second_phone2'] = $order['second_phone2'];
	$orderinfo['organization2'] = $order['organization2'];
	$orderinfo['country2'] = $this->registry['db']->getFieldOnID('countries', $order['country2'], 'name');
	$orderinfo['region2'] = $this->registry['db']->getFieldOnID('regions', $order['region2'], 'region');
	$orderinfo['city2'] = $this->registry['db']->getFieldOnID('cities', $order['city2'], 'city');
	$orderinfo['orderadress2'] = $order['adress2'];
	$orderinfo['index2'] = $order['index2'];
	$orderinfo['note2'] = $order['note2'];
	$message = $this->registry['template']->getReplaceTemplate('email_orderReg', $orderinfo);
	return $this->send($to, $subject, $message);
}

  public function Reg($to, $pass){
	$subject = "CargoTaxi - Регистрация";
	$orderinfo['email'] = $to;
	$orderinfo['pass'] = $pass;
	$message = $this->registry['template']->getReplaceTemplate('email_reg', $orderinfo);
	return $this->send($to, $subject, $message);
}

  public function newPass($to, $pass){
	$subject = "CargoTaxi - Сброс пароля";
	$orderinfo['pass'] = $pass;
	$message = $this->registry['template']->getReplaceTemplate('email_newpass', $orderinfo);
	return $this->send($to, $subject, $message);
}
  
	private function typeConvert($type){
			$type=$type=="econom"?"Эконом":$type;
			$type=$type=="express"?"Экспресс":$type;
			$type=$type=="assembled"?"Сборный груз":$type;
		return $type;
	}

}
?>