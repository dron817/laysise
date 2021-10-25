<?php
Class Controller_info Extends Controller_Base {
	
        function index($text='rules') {			
					$values['refreshscript']=$this->getNotificationScript();
						$values['content'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
						
						$values['content'] = $this->registry['template']->getReplaceTemplate($this->getRandomBanner());
						
						$text='info_'.$text;
						$val['text']=$this->registry['template']->getReplaceTemplate($text);
						
						$values['content'] .= $this->registry['template']->getReplaceTemplate('info_skin', $val);
					
					$values['content'] .= $this->registry['template']->getReplaceTemplate('calcblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('shipingblock');
					$values['content'] .= $this->registry['template']->getReplaceTemplate('economblock');
				$content = $this->registry['template']->getReplaceTemplate('main', $values);
            echo $content;
        }
		function rules() {
			$this->index('rules');
		}
		function taboo() {
			$this->index('taboo');
		}
		function packing() {
			$this->index('packing');
		}
		function express() {
			$this->index('express');
		}
		function assembled() {
			$this->index('assembled');
		}
		function about() {
			$this->index('about');
		}
		function contact() {
			$this->index('contact');
		}
}
?>