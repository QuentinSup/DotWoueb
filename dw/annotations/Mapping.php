<?php

class Mapping extends Annotation {
	
	protected $method = null;
	protected $consumes = null;
	protected $produces = null;
	
	public function getValue() {
		return $this -> value;
	}
	
	public function getMethod() {
		return $this -> method;
	}
	
	public function getConsumes() {
		return $this -> consumes;
	}
	
	public function getProduces() {
		return $this -> produces;
	}
	
}

?>