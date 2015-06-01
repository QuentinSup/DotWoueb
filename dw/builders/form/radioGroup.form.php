<?php

define('E_FORM_WRONG_CLASS', 'Wrong class element');
define('FORM_TAG_GROUP', 'radioGroup');

class radioGroupFormElement extends standardFormElement
{
	private $elements = array();
	

	public function __construct($aattributes = array(), $aelements = array())
	{
		parent::__construct($aattributes);
		$this -> tag = FORM_TAG_GROUP;
		$this -> _dontExportAttributes[] = "elements";
		foreach($aelements as $oelt)
		{
			$this -> addElement($oelt);
		}
	}	
	
	public function addElement($oelement)
	{
		if(!is_subclass_of($oelement, 'inputFormElement'))
		{
			$this -> elements[] = $oelement;
		} else {
			throw new exception(E_FORM_WRONG_CLASS);
		}
	}

}

?>