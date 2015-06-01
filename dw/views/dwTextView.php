<?php 

namespace dw\views;

use dw\classes\dwViewInterface;

class dwTextView implements dwViewInterface {
	
	protected $_str = "";
	
	public function __construct($str) {
		$this -> _str = $str;
	}
		
	public function render() {
		return $this -> _str;
	}

}

?>