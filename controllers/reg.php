<?php
Class Controller_reg Extends Controller_Base {
	
        function index() {
                    $values['title']="Регистрация - LAYSISE";
					if (!empty($_SESSION["login"])){
						header("Location: http://localhost/");
					}
					else {
						$msg['err_msg']=isset($_SESSION['no_capcha'])?'Подтвердите, что вы не робот':'';
						unset($_SESSION['no_capcha']);
						$values['content'] = $this->registry['template']->getReplaceTemplate('reg-form', $msg);
					}
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
        }
}
?>