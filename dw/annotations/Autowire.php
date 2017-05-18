<?php

/**
 * Annotation Autowire
 * @author QuentinSup
 */
class Autowire extends Annotation {
	
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
	 * @param unknown $class
	 */
	public static function processProperty($app, $reflection, $reflectionProperty, $annotationClass, $annotationProperty) {
		
		if($annotationProperty) {
		
			if($annotationProperty -> getValue()) {
				
				
				$className = $reflection -> name;
				$propName = $reflectionProperty -> name;
				
				// Logger
				if($annotationProperty -> getValue() == 'logger') {
					eval("$className::\$$propName = dw\\classes\\dwLogger::getLogger('$className');");
					return;
				}
				
				if($annotationProperty -> getValue() == 'connector') {
					$connectorName = $annotationProperty -> getName();
					eval("$className::\$$propName =  dw\dwFramework::App ()->getConnector ( '$connectorName' );");
				}
				
				if($annotationProperty -> getValue() == 'session') {
					eval("$className::\$$propName =  new dw\classes\dwSession();");
				}

			}
				
			
		}
	}
	
	
}

?>