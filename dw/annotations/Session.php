<?php

/**
 * Annotation Session
 * @author QuentinSup
 */
class Session extends Annotation {
	

	/**
	 * 
	 * @param unknown $class
	 */
	public static function processProperty($app, $reflection, $reflectionProperty, $annotationClass, $annotationProperty) {
	
		if($annotationProperty) {

			$className = $reflection -> name;
			$propName = $reflectionProperty -> name;

			eval("$className::\$$propName = new dw\classes\dwSession();");

		}
	}
	
	
}