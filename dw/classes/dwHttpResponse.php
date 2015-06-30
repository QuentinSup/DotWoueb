<?php

namespace dw\classes;

class dwHttpResponse {

	public $contentType = "text/html";
	public $statusCode = null;
	public $content = "";
	
	public function flush() {
		http_response_code($this -> statusCode);
		if(!headers_sent()) {
			header('Content-Type: '.$this -> contentType, false);
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
	
}

?>