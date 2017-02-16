<?php

namespace dw\classes;

class dwHttpResponse {
	
	public $contentType = "text/html";
	public $statusCode = null;
	public $content = "";

	private $_headers = array();

	// Logger
	private static function log() {
		static $logger = null;
		if(is_null($logger)) {
			$logger = dwLogger::getLogger(__CLASS__);
		}
		return $logger;
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
		http_response_code($this -> statusCode);
		if(!headers_sent()) {
			
			if(self::log() -> isWarnEnabled()) {
				self::log() -> warn('Headers has already been sent : headers values will be ignored');
			}
			
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
		echo $this -> content;
		ob_end_flush();
	}
	
	public function setContent($content) {
		$this -> content = $content;
	}
	
	public function start() {
		// Start treatment
		ob_start();
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