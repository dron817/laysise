<?php
Abstract Class Controller_Base {

        protected $registry;

        function __construct($registry) {
                $this->registry = $registry;
        }
		
		
		protected function cutString($string, $length, $pointed=true, $part='name'){
			$string .=' '; 
			$string = strip_tags($string);
			$string=$part=='name'?explode(' ', $string)[1]:explode(' ', $string)[0];
			$string .=' '; 
			$string = substr($string, 0, $length);
			$string = rtrim($string, "!,.-");
			$string = substr($string, 0, strrpos($string, ' '));
			
			if ($pointed) return $string."… ";		
			return $string;
		}
				
        abstract function index();
}


?>