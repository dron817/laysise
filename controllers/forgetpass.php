<?php
Class Controller_forgetpass Extends Controller_Base {
	
        function index() {
						if (!empty($_SESSION['error_forgetpass'])){
							$values['message'] = $this->registry['template']->getReplaceTemplate('error_forgetpass');
							unset($_SESSION['error_forgetpass']);
						}
						else
							$values['message'] = '';
						
						$values['content'] = $this->registry['template']->getReplaceTemplate('forgetpass', $values);
					
					$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('economblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
		}
}

?>