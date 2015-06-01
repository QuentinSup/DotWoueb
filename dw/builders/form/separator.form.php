<?php

define('FORM_TAG_SEPARATOR', 'separator');

class separatorFormElement extends standardFormElement
{
	public function __construct($aattributes = array())
	{
		parent::__construct($aattributes);
		$this -> tag = FORM_TAG_SEPARATOR;
		$this -> _dontExportAttributes[] = "value";
	}	
}

?>