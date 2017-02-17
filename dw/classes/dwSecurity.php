<?php 

namespace dw\classes;

use dw\accessors\ary;

class dwSecurity {
	
	private static $_methods = array();
	
	public static function watch($annotation, $class, $method = null) {
		self::$_methods[$class."::".$method] = $annotation;
	}
	
	public static function access($class, $method) {
		$annotation = ary::get(self::$_methods, $class."::".$method);
		
		print_r(self::$_methods);
		
		return !$annotation;
		
		
	}
	
	
}


?>