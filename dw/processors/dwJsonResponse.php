<?php 

namespace dw\processors;

class dwJsonResponse extends dwTextResponse {

	public static function getCallerName() {
		return "json";
	}
	
	public function __construct($data) {
		parent::__construct(json_encode($data, JSON_UNESCAPED_UNICODE));
	}

}

?>