<?php 

namespace dw\processors;

use dw\classes\dwHttpResponseInterface;

class dwTextResponse implements dwHttpResponseInterface {
	
	protected $_str = "";
	
	public static function getCallerName() {
		return "text";
	}

	public function __construct($str) {
		$this -> _str = $str;
	}
		
	public function render($model) {
		return $this -> _str;
	}

}