<?php
Class Controller_msg Extends Controller_Base {
	
        function index() {
					$values['refreshscript']=$this->getNotificationScript();
							$values['banner'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
						if (!empty($_SESSION["page_messege"])){
							switch($_SESSION["page_messege"]) {
								case 'SUCCRESS_REG': $msg='Регистрация прошла успешно! Теперь вы можете использовать все приемущества нашего сервиса!</p><p class="mesage">Для продолжения перейдите в <a href="?route=lk">личный кабинет и авторизуйтесь</a>'; break;
								case 'SUCCRESS_ORDER': $msg='Ваш заказ <strong>№'.$_SESSION['order'].'</strong> принят в обработку! Черз некоторое время наш менеджер свяжется с вами для уточнения деталей заказа.</p><p class="mesage">Статус заказа и подробности вы можете уточнить в <a href="?route=lk">вашем личном кабинете</a>'; break;
								case 'SUCCRESS_ORDER_AND_REG': $msg='Ваш заказ <strong>№'.$_SESSION['order'].'</strong> принят в обработку! Черз некоторое время наш менеджер свяжется с вами для уточнения деталей заказа.</p><p class="mesage"><strong>Ваши данные для входа в личный кабинет:</strong></p><p class="mesage"><strong>E-mail:</strong> '.$_SESSION['auto_login'].'</p><p class="mesage"><strong>Пароль:</strong> '.$_SESSION['auto_pass'].'<p class="mesage"><a href="?route=lk">Перейти в личный кабинет</a>';  unset($_SESSION["auto_pass"]); break;
								case 'SUCCRESS_CALLBACK': $msg='Заявка на обратный звонок принята.</p><p class="mesage">Дождитесь, пока наш менеджер свяжется с вами.'; break;
								case 'SUCCRESS_EDIT_USER': $msg='Успешно.  <a href="?route=lk#fast">Вернуться в личный кабинет</a></p><p class="mesage">Ваши персональные данные успешно изменены.'; break;
								case 'SUCCRESS_NEWPASS': $msg='Успешно. Новый пароль выслан на ваш E-mail. <a href="?route=lk#fast">Вернуться в личный кабинет</a>'; break;
								default: $msg = 'Неопознанная ошибка'; break;
							}
							$values['mesage'] = $msg;
							$values['content'] = $this->registry['template']->getReplaceTemplate('msg', $values);
						}
						else{
							$values['mesage'] = 'Неопознанная ошибка';
							$values['content'] = $this->registry['template']->getReplaceTemplate('msg', $values);
						}
						unset($_SESSION["page_messege"]);
						unset($_SESSION['auto_pass']);
						unset($_SESSION['order']);
						unset($_SESSION['auto_login']);
					$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('statusblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
        }
}
?>