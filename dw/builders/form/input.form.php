<?php

define('FORM_TAG_INPUT', 'input');

class inputFormElement extends standardFormElement
{
	public $value     = null;
	public $type      = null;	
	public $size      = null;
	public $maxlength = null;
	public $border	  = null;
	public $src		  = null;
	public $alt		  = null;
	public $lowsrc	  = null;
	public $width	  = null;
	public $height	  = null;
	public $align	  = null;
	public $vspace	  = null;
	public $hspace	  = null;
	public $accesskey = null;
	public $checked	  = null;
	public $autocomplete = null;
	public $onclick	     = null;
	public $onfocus	     = null;
	public $onblur	     = null;
	public $onkeydown	 = null;

	public function __construct($aattributes = array())
	{
		parent::__construct($aattributes);
		$this -> tag = FORM_TAG_INPUT;
	}	

	public function check($bchecked = true)
	{
		$this -> checked = ($bchecked?"CHECKED":null);
	}


}

?>