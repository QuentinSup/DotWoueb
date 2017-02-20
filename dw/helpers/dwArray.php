<?php

namespace dw\helpers;

use dw\accessors\ary;

/**
 * 
 * @author QuentinSup
 * @todo see ArrayObject alternative
 */
class dwArray {
	
	private $_array;
	
	public function __construct($ary = array()) {
		$this -> _array = $ary;
	}
	
	public function get($name, $defaultValue = null, $formatRequestFunction = null) {
		return ary::get($this -> _array, $name, $defaultValue, $formatRequestFunction);
	}
	
	public function &getA($name, $defaultValue = null, $formatRequestFunction = null) {
		return ary::get($this -> _array, $name, $defaultValue, $formatRequestFunction, TRUE);		
	}
	
	public function set($name, $mvalue) {
		ary::set($this -> _array, $name, $mvalue);
	}
	
	public function getKeys() {
		return ary::keys($this -> _array);
	}
	
	public function getKeyAt($offset) {
		return ary::keyAt($this -> _array, $offset);
	}
	
	public function isKey($name) {
		return ary::is_set($this -> _array, $name);
	}
	
	public function __get($name) {
		return $this -> get($name);
	}
	
	public function __set($name, $value) {
		$this -> set($name, $value);
	}
	
	public function __invoke($name) {
		if(!$name) {
			return $this -> _array;
		}
		return $this -> get($name);
	}
	
}


?>
