<?php

namespace dw\classes;

use dw\accessors\ary;
use dw\accessors\server;

class dwHttpRequest {
	
	protected $_requestUri = null;
	protected $_method = null;
	protected $_contentType = null;
	protected $_route = null;
	protected $_pathVars = array();
	
	public function __construct($uri = null, $method = null, $contentType = null) {
		
		if(is_null($uri)) {
			$uri = server::get('QUERY_STRING');
		}
		
		if(substr($uri, 0, 1) != "/") {
			$uri = "/".$uri;
		}
		
		if(is_null($method)) {
			$method = server::get('REQUEST_METHOD');	
		}
		if(is_null($contentType)) {
			$contentType = server::get('HTTP_ACCEPT');	
		}
		
		$this -> _requestUri = $uri;
		$this -> _method = $method;
		$this -> _contentType = $contentType;
	}
	
	public function setRoute($route) {
		$this -> _route = $route;
	}
	
	public function getRoute() {
		return $this -> _route;
	}
	
	public function getMethod() {
		return $this -> _method;
	}
	
	public function getRequestUri() {
		return $this -> _requestUri;	
	}
	
	public function getContentType() {
		return $this -> _contentType;
	}
	
	public function setPathVars($pathVars) {
		$this -> _pathVars = $pathVars;
	}
	
	public function getPathVars() {
		return $this -> _pathVars;
	}
	
	public function getPathVar($varName, $defaultValue = null) {
		return ary::get($this -> _pathVars, $varName, $defaultValue);
	}
	
	public function Path($varName, $defaultValue = null) {
		return $this -> getPathVar($varName, $defaultValue);
	}
	
	public function getHostName() {
		return server::get('SERVER_NAME');
	}
	
}

?>