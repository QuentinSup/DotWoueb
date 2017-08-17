<?php 

namespace dw\classes\http;

use dw\accessors\ary;
use dw\classes\dwLogger;

dw_require('vendors/Requests/Requests');

\Requests::register_autoloader();

class dwHttpClient {
	
	const HTTP_METHOD_GET = "GET";
	const HTTP_METHOD_POST = "POST";
	const HTTP_METHOD_DELETE = "DELETE";
	const HTTP_METHOD_PUT = "PUT";
	const HTTP_METHOD_PATCH = "PATCH";
	const HTTP_METHOD_OPTIONS = "OPTIONS";
	const HTTP_METHOD_TRACE = "TRACE";
	
	protected $_headers;

	/**
	 * Logger
	 * @return logger
	 */
	private static function logger() {
		static $log = null;
		if(is_null($log)) {
			$log = dwLogger::getLogger(__CLASS__);
		}
		return $log;
	}
	
	public function __construct() {
		$this -> _headers = array();
	}

	public function setHeaders($headers) {
		ary::push($this -> _headers,  $headers);
	}
	
	/**
	 * Send GET request
	 * @param unknown $url
	 * @param array $options
	 * @return unknown
	 */
	public function Get($url, $options = array()) {
		return $this -> send(self::HTTP_METHOD_GET, $url, null, $options);
	}
	
	/**
	 * Send request
	 * @param unknown $method
	 * @param unknown $url
	 * @param unknown $data
	 * @param array $options
	 * @return unknown|boolean
	 */
	public function send($method, $url, $data, $options = array()) {
		try {
			$response = \Requests::request($url, $this -> _headers, $data, $method, $options);
			return $response;
		} catch(\Exception $e) {
			self::logger() -> error("Error when trying to call request $method $url", $e);
		}
		return FALSE;
	}

	public static function request($method, $url, $content, $headers = array(), $options = array()) {
		$httpsocket = new dwHttpClient();
		$httpsocket -> setHeaders($headers);
		return $httpsocket -> send($method, $url, $content, $options);
		
	}

}


?>