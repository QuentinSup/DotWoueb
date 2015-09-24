<?php

namespace dw\classes;

use dw\accessors\ary;
use dw\accessors\request;
use dw\accessors\server;

class dwHttpRequest {
	
	protected $_requestUri = null;
	protected $_method = null;
	protected $_contentType = null;
	protected $_route = null;
	protected $_pathVars = array();
	
	public function __construct($uri = null, $method = null, $contentType = null) {
				
		if(is_null($uri)) {

			$uri = ary::get(server::get('argv'), 0);
			if(!$uri || $uri == 'PHPSESSID') {
				$uri = "/";
			}

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
	
	public function getRequestParam($varName, $defaultValue = null) {
		return request::get($varName, $defaultValue);
	}
	
	public function Param($varName, $defaultValue = null) {
		return $this -> getRequestParam($varName, $defaultValue);
	}
	
	public function getRequestBody() {
		static $postdata = null;
		if(is_null($postdata)) {
			$postdata = file_get_contents("php://input");
		}
		return $postdata;
	}
	
	public function Body() {
		return $this -> getRequestBody();
	}
	
	public function getPostParam($varName, $defaultValue = null) {
		return post::get($varName, $defaultValue);
	}
	
	public function Post($varName, $defaultValue = null) {
		return $this -> getPostParam($varName, $defaultValue);
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
	
	public function getScheme() {
		return server::get('REQUEST_SCHEME', 'http');
	}
	
	public function getHostName() {
		return server::get('SERVER_NAME');
	}
	
	public function getRemoteAddr() {
		return server::get('REMOTE_ADDR');
	}
	
	public function getContext() {
		return server::get('CONTEXT_PREFIX');
	}
	
	public function getBaseUri() {
		return $this -> getScheme().'://'.$this -> getHostName().$this -> getContext()."/";
	}
	
	public function getClientIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	
}

?>