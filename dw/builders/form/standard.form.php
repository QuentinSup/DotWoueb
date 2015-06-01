<?php

abstract class standardFormElement extends dwHTMLTag
{
	public $frozen	    = false;
	public $value       = null;
	public $defaultvalue= null;
	public $label		= null;
	public $after		= null;
	public $before		= null;
	public $comment		= null;
	
	public $name 	 = null;
	public $tabindex = null;
	public $readonly = null;
	public $disabled = null;
	public $language     = null;
	public $onchange	 = null;
	public $onkeypress	 = null;
	private $_rules		 = array();
	
	public function __construct($aattributes)
	{
		parent::__construct($aattributes);
		$this -> _dontExportAttributes[] = "frozen";
		$this -> _dontExportAttributes[] = "tag";
		$this -> _dontExportAttributes[] = "after";
		$this -> _dontExportAttributes[] = "before";
		$this -> _dontExportAttributes[] = "label";
		$this -> _dontExportAttributes[] = "comment";
	}

	public function setRequired($brequired = true)
	{
		if($brequired)
		{
			$this -> addRule('required');
		} else {
			$this -> removeRule('required');
		}
	}

	public function getValue()
	{
		return $this -> value;
	}
	
	public function setValue($svalue = null)
	{
		$this -> value = $svalue;
	}

	public function freeze()
	{
		$this -> frozen = true;
	}
	
	public function isFrozen()
	{
		return $this -> frozen;
	}
	
	public function getTag()
	{
		return $this -> tag;
	}
	
	public function addRule($srule)
	{
		$this -> _rules[$srule] = 1;
	}
	
	public function removeRule($srule)
	{
		unset($this -> _rules[$srule]);
	}
	
	public function getRules()
	{
		return $this -> _rules;
	}
	
	public function isRequired()
	{
		return isset($this -> _rules['required']);
	}
	
}

?>