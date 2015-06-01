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
	}
	
	public function setContent($content) {
		$this -> content = $content;
	}
	
}

?>