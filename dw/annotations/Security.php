<?php

use dw\classes\dwSecurity;

/**
 * Annotation Security
 * @author QuentinSup
 */
class Security extends Annotation {
	
	protected $name = '';
	
	/**
	 * @return the value set
	 */
	public function getValue() {
		return $this -> value;
	}
	
	/**
	 * @return the name set
	 */
	public function getName() {
		return $this -> name;
	}

	/**
	 * 
	 * @param unknown $app
	 * @param unknown $reflection
	 * @param unknown $annotationClass
	 */
	public static function processClass($app, $reflection, $annotationClass) {
		$className = $reflection -> name;
		dwSecurity::watch($annotationClass, $className, null);

	}
	
	/**
	 * 
	 * @param unknown $app
	 * @param unknown $reflection
	 * @param unknown $reflectionMethod
	 * @param unknown $annotationClass
	 * @param unknown $annotationMethod
	 */
	public static function processMethod($app, $reflection, $reflectionMethod, $annotationClass, $annotationMethod) {

		if($annotationMethod) {
		
			$className = $reflection -> name;
			$methodName = $reflectionMethod -> name;
			
			dwSecurity::watch($annotationMethod, $className, $methodName);
			
		}
	}
	
	
}

?>