<?php

namespace dw\classes;

class dwHttpResponse {
	
	public $contentType = "text/html";
	public $statusCode = null;

	private $_headers = array();

	// Logger
	private static function log() {
		static $logger = null;
		if(is_null($logger)) {
			$logger = dwLogger::getLogger(__CLASS__);
		}
		return $logger;
	}
	
	public function status($code) {
		$this -> statusCode = $code;
		http_response_code($code);
	}
	
	public function isHeadersSent() {
		return headers_sent();
	}
		
	public function setHeader($name, $value) {
		$this -> _headers[$name] = $value;
	}
	
	public function Header($name, $value) {
		if(!is_null($value)) {
			$this -> setHeader($name, $value);
		}
	}
	
	public function sendHeaders() {
		$this -> status($this -> statusCode);
		if($this -> isHeadersSent()) {

			if(self::log() -> isWarnEnabled()) {
				self::log() -> warn('Headers has already been sent : headers values will be ignored');
			}
		
		} else {
			
			header('Content-Type: '.$this -> contentType, false);
			
			$headers = array_keys($this -> _headers);
			foreach($headers as $header) {
				header($header.': '.$this -> _headers[$header], true);
			}
			
		}

	}
	
	public function isJSONContent() {
		return $this -> contentType && (strpos(strtolower($this -> contentType), "application/json") !== FALSE);
	}
	
	public function flush() {
		if(!$this -> isHeadersSent()) {
			$this -> sendHeaders();
		}
		ob_end_flush();
	}
	
	public function end() {
		$this -> flush();
		die;
	}
	
	public function out($content) {
		echo $content;
	}
	
	public function start() {
		// Start treatment
		ob_implicit_flush(FALSE);
		
		if(DW_INIT_GZIP) {
			ob_start("ob_gzhandler");
		} else {
			ob_start();
		}
	}
	
	public function stream($data = null) {
		if(!$this -> isHeadersSent()) {
			$this -> sendHeaders();
		}
		if(!is_null($data)) echo $data;
		ob_flush();
	}
	
}

?>