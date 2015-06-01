<?php

define('FORM_TAG_SELECT', 'select');

class selectFormElement extends standardFormElement
{
	public $multiple     = null;	
	public $size      	 = null;
	public $onfocus	     = null;
	public $onblur	     = null;

	public $options     = array();

	public function __construct($aattributes = array())
	{
		parent::__construct($aattributes);
		$this -> tag = FORM_TAG_SELECT;
		$this -> _dontExportAttributes[] = "value";
		$this -> _dontExportAttributes[] = "options";
	}

	public function setOptions($aOptions, $svalue = null)
	{
		if(!is_null($svalue))
		{
			$this -> value = $svalue;
		}
		foreach(array_keys($aOptions) as $value)
		{
			$this -> setOption($aOptions[$value], $value);
		}
	}

	public function getOptions()
	{
		return $this -> options;
	}

	public function setOption($stext, $svalue = null, $bselected = false)
	{
		if(is_null($svalue))
		{
			$svalue = $stext;
		}
		$this -> options[$svalue] = $stext;
		if($bselected)
		{
			$this -> value = $svalue;
		}
	}
	
}

?>