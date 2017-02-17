<?php 

namespace dw\views;

use dw\helpers\dwFile;

class dwFileView extends dwTextView {

	public static function getCallerName() {
		return "file";
	}
	
	public function __construct($filename) {
		parent::__construct(dwfile::getContents($filename));
	}

}

?>