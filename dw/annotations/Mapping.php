<?php

/**
 * Annotation Mapping
 * @author qsupernant
 */
class Mapping extends Annotation {
	
	protected $method = null;
	protected $consumes = null;
	protected $produces = null;
	
	/**
	 * @return the value set
	 */
	public function getValue() {
		return $this -> value;
	}
	
	/**
	 * @return the method set
	 */
	public function getMethod() {
		return $this -> method;
	}
	
	/**
	 * @return the consumes property value
	 */
	public function getConsumes() {
		return $this -> consumes;
	}
	
	/**
	 * @return the produces property value
	 */
	public function getProduces() {
		return $this -> produces;
	}
	
	/**
	 * 
	 * @param unknown $class
	 */
	public static function process($app, $fn, $mappingClass, $mappingMethod) {
		
		if($mappingClass) {
		
			$value = "";
			if($mappingClass -> getValue()) {
				$value = $mappingClass -> getValue();
				if(substr($value, strlen($value) - 1) != "/") {
					$value .= "/";
				}
			}
				
			$uri = $value.$mappingMethod -> getValue();
			$method = $mappingMethod -> getMethod()?$mappingMethod -> getMethod():$mappingClass -> getMethod();
			$consumes = $mappingMethod -> getConsumes()?$mappingMethod -> getConsumes():$mappingClass -> getConsumes();
			$produces = $mappingMethod -> getProduces()?$mappingMethod -> getProduces():$mappingClass -> getProduces();
				
			$app -> getRouteMap() -> addRoute(
					$uri,
					$fn,
					$method,
					$consumes,
					$produces);
		} else {

			$app -> getRouteMap() -> addRoute(
					$mappingMethod -> getValue(),
					$fn,
					$mappingMethod -> getMethod(),
					$mappingMethod -> getConsumes(),
					$mappingMethod -> getProduces());
		}
	}
	
	
}

?>