<?php

namespace dw\classes;

use dw\accessors\ary;

class dwRoute {
	
	protected $_uri = null;
	protected $_method = null;
	protected $_consumes = null;
	protected $_produces = null;
	protected $_routeFn = null;
	
	public function __construct($uri, $method, $consumes, $produces) {

		if(substr($uri, 0, 1) != "/") {
			$uri = "/".$uri;
		}
		
		$this -> _uri 		= $uri;
		$this -> _method 	= $method?strtoupper($method):null;
		$this -> _consumes 	= $consumes;
		$this -> _produces 	= $produces;
	}
	
	public function setRouteFunction($routeFn) {
		$this -> _routeFn = $routeFn;
	}
	
	public function getRouteFunction() {
		return $this -> _routeFn;
	}
	
	public function getUri() {
		return $this -> _uri;
	}
	
	public function getMethod() {
		return $this -> _method;
	}
	
	public function getConsumes() {
		return $this -> _consumes;
	}
	
	public function getProduces() {
		return $this -> _produces;
	}
		
	public function getScore() {

		$nbvars = mb_substr_count($this -> _uri, ":");
		$nbopts = mb_substr_count($this -> _uri, "?");
		$weight = mb_substr_count($this -> _uri, "/") * 10 - $nbvars - $nbopts;

		if(!$this -> _routeFn) {
			$weight--;
		}
		
		if(!$this -> _method) {
			$weight--;
		}
		
		if(!$this -> _consumes) {
			$weight--;
		}
								   
		return $weight;
	}
								   
	public function isRouteMatch($uri = null, $method = null, $consumes = null, &$pathVars = array()) {

		$routeUri = $this -> getUri();
		$routeMethod = $this -> getMethod();			
		$routeConsumes = $this -> getConsumes();	

		// Check method
		if($routeMethod && $method != $routeMethod) {
			return false;
		}

		// Check method
		if($routeConsumes && !is_null($consumes)) {
			if(!self::isConsumesMatch($consumes, $routeConsumes)) {
				return false;
			}
		}
		
		// Check static uri
		if(!self::isUriMatch($routeUri, $uri, $pathVars)) {
			return false;
		}

		return true;
		
	}
								   							   
	public static function isConsumesMatch($haystack, $needle) {
		$ary = explode(",", $haystack);
		foreach($ary as $value) {
			if($value == $needle) {
				return true;
			}
		}	
		return false;
	}
	
	public static function isUriMatch($haystack, $needle, &$pathVars = array()) {
		
		if($haystack == $needle) {
			return true;
		}
		
		$haystackList = explode("/", $haystack);
		$needleList = explode("/", $needle);

		if(count($haystackList) != count($needleList)) {
			return false;
		}
				
		foreach($haystackList as $index => $value) {
			$needleValue = $needleList[$index];
			if(substr($value, 0, 1) == ":") {
				$var = substr($value, 1);
				
				if(substr($var, strlen($var) - 1) == "?") {
					$var = substr($var, 0, strlen($var) - 1);
				} else {
					if($needleValue == "") {
						return false;
					}
				}
				$pathVars[$var] = $needleValue;
				continue;
			}
						
			if($value != $needleValue) {
				return false;
			}
			
		}	
				
		return true;
	}
	
}

?>