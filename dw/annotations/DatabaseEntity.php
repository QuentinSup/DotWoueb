<?php

/**
 * Annotation DatabaseEntity
 * @author QuentinSup
 */
class DatabaseEntity extends Annotation {
	
	protected $dbname = '';
	
	/**
	 * @return the value set
	 */
	public function getValue() {
		return $this -> value;
	}
	
	/**
	 * @return the name set
	 */
	public function getDBName() {
		return $this -> dbname;
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
				
				$dbname = $annotationProperty -> getDBName();
				$entityName = $annotationProperty -> getValue();
				
				if($dbname) {
					$db = dw\dwFramework::App ()->getConnector($dbname);
				} else {
					$db = dw\dwFramework::DB();
				}

				eval("$className::\$$propName = \$db -> factory ('$entityName');");

			}
				
			
		}
	}
	
	
}