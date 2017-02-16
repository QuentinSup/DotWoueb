<?php

/**
 * Annotation Database
 * @author QuentinSup
 */
class Database extends Annotation {
	
	/**
	 * @return the value set
	 */
	public function getValue() {
		return $this -> value;
	}

	
	/**
	 * 
	 * @param unknown $class
	 */
	public static function processProperty($app, $reflection, $reflectionProperty, $annotationClass, $annotationProperty) {
		
		if($annotationProperty) {
		
			if($annotationProperty -> getValue()) {
				
				$className = $reflection -> name;
				$propName = $reflectionProperty -> name;
				
				$dbname = $annotationProperty -> getValue();
				
				if($dbname) {
					$db = dw\dwFramework::App ()->getConnector($dbname);
				} else {
					$db = dw\dwFramework::DB();
				}

				eval("$className::\$$propName = \$db;");

			}
				
			
		}
	}
	
	
}

?>