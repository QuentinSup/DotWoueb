<?php 

namespace dw\views;

class dwJsonView extends dwTextView {

	public static function getCallerName() {
		return "json";
	}
	
	public function __construct($data) {
		parent::__construct(json_encode($data, JSON_UNESCAPED_UNICODE));
	}

}

?>