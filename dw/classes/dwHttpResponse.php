<?php

namespace dw\classes;

class dwHttpResponse {

	public $contentType = "text/html";
	public $statusCode = null;
	public $content = "";
	
	public function isHeadersSent() {
		return headers_sent();
	}
		
	public function sendHeaders() {
		http_response_code($this -> statusCode);
		if(!headers_sent()) {
			header('Content-Type: '.$this -> contentType, false);
		}	
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