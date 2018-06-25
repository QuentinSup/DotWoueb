<?php 

namespace dw\processors;

use dw\helpers\dwFile;

class dwFileResponse extends dwTextResponse {

	public static function getCallerName() {
		return "file";
	}
	
	public function __construct($filename) {
		parent::__construct(dwfile::getContents($filename));
	}

}