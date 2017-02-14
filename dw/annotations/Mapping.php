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
	
}

?>