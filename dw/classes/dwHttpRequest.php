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
	protected $_headers = array();
	protected $_context = null;
	
	/**
	 * constructor
	 * @param unknown $uri
	 * @param unknown $method
	 * @param unknown $contentType
	 */
	public function __construct($uri = null, $method = null, $contentType = null) {

		$context = server::get('CONTEXT_PREFIX');
		
		// Wrong value
		if($context == "/system-bin/") {
			$context = "";
		}
		
		if(!$context) {
		   
		   // Resolve context from SCRIPT_NAME
		   $scriptName = server::get('SCRIPT_NAME');
		   $scriptPath = explode('/', $scriptName);
		   
		   if(count($scriptPath) > 2) {
		       $context = '/'.$scriptPath[1];
		   }
		   
		}

		if(is_null($uri)) {
			// build $uri
			$uri = explode('?', server::get('REQUEST_URI'))[0];
			$uri = substr($uri, strlen($context));
		}

		$uri = dwRoute::smoothuri(urldecode($uri));
		
		if(is_null($method)) {
			$method = server::get('REQUEST_METHOD');	
		}
		if(is_null($contentType)) {
			$contentType = server::get('CONTENT_TYPE');	
		}
		
		$this -> _context = $context;
		$this -> _requestUri 	= $uri;
		$this -> _method 		= $method;
		$this -> _contentType 	= $contentType;
		$this -> _headers 		= getallheaders();

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
	
	/**
	 * Return the requested uri
	 * @return unknown
	 * @deprecated
	 * @see getUri()
	 */
	public function getRequestUri() {
		return $this -> _requestUri;	
	}
	
	/**
	 * Return the requested uri
	 * @return unknown
	 */
	public function getUri() {
		return $this -> _requestUri;
	}
	
	/**
	 * Return the query string
	 * @return unknown
	 */
	public function getQuery() {
		return server::get('QUERY_STRING');
	}
	
	public function getOrigin() {
		return $this -> getRoot().server::get('REQUEST_URI');
	}
	
	public function getReferer() {
		return server::get('HTTP_REFERER');
	}
	
	public function getContentType() {
		return $this -> _contentType;
	}
	
	public function getRequestParam($varName, $defaultValue = null) {
		return request::get($varName, $defaultValue);
	}
	

	public function getRequestBody() {
		static $postdata = null;
		if(is_null($postdata)) {
			$postdata = file_get_contents("php://input");
		}
		return $postdata;
	}
	
	public function isJSONContent() {
		return $this -> _contentType && (strpos(strtolower($this -> _contentType), "application/json") != -1);
	}
	
	public function getPostParam($varName, $defaultValue = null) {
		return post::get($varName, $defaultValue);
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

	public function getScheme() {
		return server::get('REQUEST_SCHEME', 'http');
	}
	
	public function getHost() {
		return server::get('HTTP_HOST');
	}
	
	public function getServerName() {
		return server::get('SERVER_NAME');
	}
	
	public function getRemoteAddr() {
		return server::get('REMOTE_ADDR');
	}
	
	public function getContext() {
		return $this -> _context;
	}
	
	public function getProtocol() {
		return server::get('SERVER_PROTOCOL');
	}
	
	public function getServerPort() {
		return server::get('SERVER_PORT');
	}
	
	public function getRoot() {
		return $this -> getScheme().'://'.$this -> getHost();
	}
	
	public function getBaseUri($uri = "/") {
		$url = $this -> getRoot().$this -> getContext();
		
		if($uri && $uri[0] != "/") {
			$uri = "/".$uri;
			
		}
		
		$url .= $uri;
		
		return $url;
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
	
	public function getHeader($name, $defaultValue = null) {
		 return ary::get($this -> _headers, $name, $defaultValue);
	}
	
	public function isHeaderExists($name) {
		return isset($this -> _headers[$name]);
	}
	
	public function Body() {
		$body = $this -> getRequestBody();
		if($this -> isJSONContent()) {
			return new dwObject(json_decode($body));
		}
		return $body;
	}
	
	public function Path($varName, $defaultValue = null) {
		return urldecode($this -> getPathVar($varName, $defaultValue));
	}
	
	public function Post($varName, $defaultValue = null) {
		return $this -> getPostParam($varName, $defaultValue);
	}
	
	public function Param($varName, $defaultValue = null) {
		return $this -> getRequestParam($varName, $defaultValue);
	}
	
	public function Header($varName, $defaultValue = null) {
		return $this -> getHeader($varName, $defaultValue);
	}
	
	public function getUploadedFile($name) {
		return request::getRequestFile($name);
	}
	
	public function File($name) {
		return $this -> getUploadedFile($name);
	}
}