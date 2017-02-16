<?php

include_lib('builders/dwFormBuilder.php');

/**
 * Sch魡 for Application Page
 * Classe permettant de g鲥r les param鴲es de formulaire de l'application
 * @author Quentin Supernant
 * @package dotWoueb
 */

class dwSAP_buttons extends inputFormElement
{
	public function __construct($stype, $aattributes = array())
	{
		parent::__construct($aattributes);
		$this -> type = $stype; 
		$this -> _dontExportAttributes[] = "event";
		$this -> _dontExportAttributes[] = "rule";
	}
}

class dwSAP_form 
{
	public $title   = null;	
	public $buttons = array();
	public $ignoreFields = array();
	public $canInsert    = true;
	public $canUpdate    = false;
	public $canDelete    = false;
	
	protected function createButton($button)
	{
		$oelt = new dwSAP_buttons('submit', $button -> toArray());
		$this -> buttons[] = $oelt;	
	}
	
	public function __construct($oxform = null)
	{
		$this -> title = (string)$oxform -> title -> cdata;
		if(!is_null($oxform -> buttons))
		{
			if(is_array($oxform -> buttons -> button))
			{
				foreach($oxform -> buttons -> button as $button)
				{
					$this -> createButton($button);
				}
			} else {
				$this -> createButton($oxform -> buttons -> button -> toArray());	
			}
		}	
		if(isset($oxform -> ignorefields))
		{
			$this -> ignoreFields = explode(',', (string)$oxform -> ignorefields -> cdata);
		}
		if(isset($oxform -> accessRules))
		{
			$this -> canInsert = (int)$oxform -> accessRules -> insert == 1;
			$this -> canUpdate = (int)$oxform -> accessRules -> update == 1;
			$this -> canDelete = (int)$oxform -> accessRules -> delete == 1;
		}
	}
	
	public function isReadOnly()
	{
		return !($this -> canInsert || $this -> canUpdate || $this -> canDelete);
	}
	
}

class dwSAP extends dwXMLConfig
{
	public static $path = './sap/';
	
	protected $_oform   = null;
	
	public function __construct($spage)
	{
		$this -> _sschemaName = $spage;
		
		$oxml = $this -> loadConfig(self::$path, $spage.'.xml');
		if($oxml)
		{
			$this -> _oform = new dwSAP_form($oxml -> form);
		}
	}
	
	public function getSchemaName()
	{
		return $this -> _sschemaName;
	}
	
	public function getForm()
	{
		return $this -> _oform;
	}
}

?>