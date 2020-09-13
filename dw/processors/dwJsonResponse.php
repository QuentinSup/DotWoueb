<?php 

namespace dw\processors;

class dwJsonResponse extends dwTextResponse {
	
	public static function getCallerName() {
		return "json";
	}
	
	public function __construct($data) {

	    $json = null;
	    
	    if(isset($data) && (is_array($data) || strlen($data) > 0)) {
	        
	        $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_IGNORE);
		
    		  if($json === FALSE) {
                throw new \Exception(json_last_error_msg());
    		  }
	    }
	    
		parent::__construct($json);
	}

}