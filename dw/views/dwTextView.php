<?php 

namespace dw\views;

use dw\classes\dwViewInterface;

class dwTextView implements dwViewInterface {
	
	public static function getCallerName() {
		return "text";
	}
	
	protected $_str = "";
	
	public function __construct($str) {
		$this -> _str = $str;
	}
		
	public function render($model) {
		return $this -> _str;
	}

}

?>