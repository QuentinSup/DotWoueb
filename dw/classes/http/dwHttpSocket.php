<?php 

namespace dw\classes\http;

use dw\helpers\dwArray;
use dw\classes\dwSocket;
use dw\classes\dwObject;

dw_require('vendors/Requests/Requests');

\Requests::register_autoloader();

class dwHttpSocket {
	
	public static $HTTP_METHOD_GET = "GET";
	public static $HTTP_METHOD_POST = "POST";
	public static $HTTP_METHOD_DELETE = "DELETE";
	public static $HTTP_METHOD_PUT = "PUT";
	public static $HTTP_METHOD_PATCH = "PATCH";
	public static $HTTP_METHOD_OPTIONS = "OPTIONS";
	
	private $_socket;

	protected $_headers;
	protected $_protocol = "HTTP/1.1";
	
	public $connectionTimeout = 30;
	
	
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

	public static function request(\String $method, \String $url, \String $content, $headers = array(), $options = array()) {
		
		$httpsocket = new dwHttpSocket();
		$httpsocket -> setHeaders($headers);
		return $httpsocket -> send($method, $url, $content, $options);
		
	}

}


?>