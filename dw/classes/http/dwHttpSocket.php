<?php 

namespace dw\classes\http;

use dw\accessors\ary;

dw_require('vendors/Requests/Requests');

\Requests::register_autoloader();

class dwHttpSocket {
	
	public static $HTTP_METHOD_GET = "GET";
	public static $HTTP_METHOD_POST = "POST";
	public static $HTTP_METHOD_DELETE = "DELETE";
	public static $HTTP_METHOD_PUT = "PUT";
	public static $HTTP_METHOD_PATCH = "PATCH";
	public static $HTTP_METHOD_OPTIONS = "OPTIONS";
	
	protected $_headers;

	public function __construct() {
		$this -> _headers = array();
	}

	public function setHeaders($headers) {
		ary::push($this -> _headers,  $headers);
	}
	
	public function Get($url, $content) {
		return $this -> send(self::$HTTP_METHOD_GET, $url, null);
	}
	
	public function send($method, $url, $data, $options = array()) {
		$response = \Requests::request($url, $this -> _headers, $data, $method, $options);
		return $response;
			
	}

	public static function request($method, $url, $content, $headers = array(), $options = array()) {
		
		$httpsocket = new dwHttpSocket();
		$httpsocket -> setHeaders($headers);
		return $httpsocket -> send($method, $url, $content, $options);
		
	}

}


?>