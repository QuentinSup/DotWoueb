<?php 

namespace dw;

use dw\accessors\ary;
use dw\classes\dwHttpRequest;
use dw\classes\dwHttpResponse;

class dwSecurityController {
	
	private static $_methods = array();
	
	/**
	 * 
	 * @param unknown $annotation
	 * @param unknown $class
	 * @param unknown $method
	 */
	public static function watch($annotation, $class, $method = null) {
		$key = $class."::".$method;
		$ary = ary::get(self::$_methods, $key, array());
		$ary[] = $annotation;
		self::$_methods[$key] = $ary;
	}
	
	/**
	 * 
	 * @param unknown $class
	 * @param unknown $method
	 * @return boolean
	 */
	public static function access($class, $method, dwHttpRequest $request, dwHttpResponse $response) {
		$annotations = ary::get(self::$_methods, $class."::", array());
		$annotations = $annotations + ary::get(self::$_methods, $class."::".$method, array());
		
		foreach($annotations as $security) {
			$value = $security -> getValue();

			if(!$value) {
				$value = 'Basic';
			}
			
			if($value == 'Basic') {
				$authentControler = new \dw\adapters\security\dwBasicAuthorization();
				if(!$authentControler -> control($request, $response)) {
					return false;
				}
			}
	
		}
		
		return true;
	}
		
}

?>