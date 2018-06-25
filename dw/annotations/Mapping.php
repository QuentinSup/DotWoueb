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
	public static function processMethod($app, $reflection, $reflectionMethod, $annotationsClass, $annotationsMethod) {
		
		$classMethod = "class";
		$fn = $reflectionMethod -> $classMethod."::".$reflectionMethod -> name;
		
		if($annotationsClass) {
		
			$value = "";
			if($annotationsClass -> getValue()) {
				$value = $annotationsClass -> getValue();
				if(substr($value, strlen($value) - 1) != "/") {
					$value .= "/";
				}
			}
				
			$uri = $value.$annotationsMethod -> getValue();
			$method = $annotationsMethod -> getMethod()?$annotationsMethod -> getMethod():$annotationsClass -> getMethod();
			$consumes = $annotationsMethod -> getConsumes()?$annotationsMethod -> getConsumes():$annotationsClass -> getConsumes();
			$produces = $annotationsMethod -> getProduces()?$annotationsMethod -> getProduces():$annotationsClass -> getProduces();
				
			$app -> getRouteMap() -> addRoute(
					$uri,
					$fn,
					$method,
					$consumes,
					$produces);
		} else {

			$app -> getRouteMap() -> addRoute(
					$annotationsMethod -> getValue(),
					$fn,
					$annotationsMethod -> getMethod(),
					$annotationsMethod -> getConsumes(),
					$annotationsMethod -> getProduces());
		}
	}
	
	
}