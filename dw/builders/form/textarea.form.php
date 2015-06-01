<?php

define('FORM_TAG_TEXTAREA', 'textarea');

class textareaFormElement extends standardFormElement
{
	public $cols      = null;
	public $rows      = null;	
	public $wrap      = null;
	
	public function __construct($aattributes = array())
	{
		parent::__construct($aattributes);
		$this -> tag = FORM_TAG_TEXTAREA;
		$this -> _dontExportAttributes[] = "value";
	}	

	
}

?>