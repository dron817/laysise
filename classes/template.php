<?php
Class Template {
 
	private $registry;
	private $vars = array();
	
function __construct($registry) {
	$this->registry = $registry;
}
		
	public function getReplaceTemplate($template, $values=null){
		$values['adress'] = $this->registry['adress'];
		$values['logout_link'] = $this->registry['logout_link'];
		
		return $this->getReplaceContent($this->getTemplate($template), $values);
	}
		
	protected function getTemplate($template){
		$path = site_path . 'tpl' . DIRSEP . $template . '.tpl';
		$text = file_get_contents($path);
		return($text);
	}
	
	protected function getReplaceContent($content, $values){
		if (empty($values['scripts'])) $values['scripts']='';
		$search = array();
		$replace = array();
		$i=0;
		foreach ($values as $key => $value){
			$search[$i] = "%".$key."%";
			$replace[$i] = $value;
			$i++;
		}
		return str_replace($search, $replace, $content);
	}

}
 
 
?>