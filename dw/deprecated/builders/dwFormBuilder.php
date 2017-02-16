<?php

include_once(dirname(__FILE__).'/form/standard.form.php');
include_once(dirname(__FILE__).'/form/input.form.php');
include_once(dirname(__FILE__).'/form/select.form.php');
include_once(dirname(__FILE__).'/form/radioGroup.form.php');
include_once(dirname(__FILE__).'/form/textarea.form.php');
include_once(dirname(__FILE__).'/form/separator.form.php');
include_once(dirname(__FILE__).'/form/rules/prototype.rule.php');
include_once(dirname(__FILE__).'/form/rules/required.rule.php');

define('FORM_ELEMENT_INPUT', 'input');
define('FORM_ELEMENT_TEXT', 'text');
define('FORM_ELEMENT_PASSWORD', 'password');
define('FORM_ELEMENT_HIDDEN', 'hidden');
define('FORM_ELEMENT_CHECKBOX', 'checkbox');
define('FORM_ELEMENT_RADIO', 'radio');
define('FORM_ELEMENT_SELECT', 'select');
define('FORM_ELEMENT_TEXTAREA', 'textarea');
define('FORM_ELEMENT_SUBMIT', 'submit');
define('FORM_ELEMENT_RESET', 'reset');
define('FORM_ELEMENT_BUTTON', 'button');
define('FORM_ELEMENT_FILE', 'file');
define('FORM_ELEMENT_IMAGE', 'image');

define('E_FORM_ELEMENT_EXIST', 'form element already exist');
define('E_FORM_ELEMENT_UNKOWN', 'unknow form element');
define('E_FORM_RULE_UNKOWN', 'unknow rule');

class dwForm_attributes extends dwHTMLTag
{
	public $name     = null;
	public $action   = "./";
	public $method   = "POST";
	public $enctype  = null;	
}

class dwForm extends dwHTMLTag
{
	public $attributes = null;
	public $elements   = array();
	public $title	   = null;
	public $formatRequestFunction = 'trim';
	protected $_bfrozen  = false;
	protected $_bvalid     = null;
	protected $_bvalidated = false;
	protected $_aerrors  = array();
	protected $_arules   = array();
	protected $_aevents  = array();
	protected $_agroupList = array();
	
	public function __construct($sname, $saction = "./", $smethod = "POST", $senctype = null)
	{
		$this -> attributes = new dwForm_attributes(
			array(
				"name"   => $sname,
				"action" => $saction,
				"method" => $smethod,
				"enctype"=> $senctype
			));
	}

	public function inline()
	{
		$this -> _agroupList[] = func_get_args();
	}

	public function groupElements()
	{
		$this -> _agroupList[] = func_get_args();
	}
	
	public function addGroupList($agroupList)
	{
		$this -> _agroupList[] = $agroupList;
	}
	
	public function getGroupList()
	{
		return $this -> _agroupList;
	}

	public function setTitle($stitle)
	{
		$this -> title = $stitle;
	}
	
	public function getTitle()
	{
		return $this -> title;
	}

	public function &addElement($oelt)
	{
		if(isset($this -> elements[$oelt -> name]))
		{
			throw new exception(E_FORM_ELEMENT_EXIST);
		}
		$this -> synchronize($oelt);
		$this -> elements[$oelt -> name] = &$oelt;
		return $oelt;
	}
	
	public static function newElementInput($aattributes)
	{
		return new inputFormElement($aattributes);
	}

	public static function newSeparator($aattributes)
	{
		return new separatorFormElement($aattributes);
	}
	
	public static function newElementRadioGroup($aattributes)
	{
		return new radioGroupFormElement($aattributes);
	}

	public static function newElementSelect($aattributes)
	{
		return new selectFormElement($aattributes);
	}

	public static function newElementTextarea($aattributes)
	{
		return new textareaFormElement($aattributes);
	}

	public function addHidden($sname, $svalue = null, $aattributes = array())
	{
		$oelt = self::newElementInput(array(
							"type" => "hidden",
							"name" => $sname,
							"value"=> $svalue
							));
		$oelt -> setAttributes($aattributes);
		return $this -> addElement($oelt);
	}

	public function addElementInput($aattributes = array())
	{
		return $this -> addElement(self::newElementInput($aattributes));
	}

	public function addElementRadioGroup($aattributes = array())
	{
		return $this -> addElement(self::newElementRadioGroup($aattributes));
	}
	
	public function addSelect($sname, $slabel, $aoptions, $svalue = null, $sstyle = null, $aattributes = array())
	{
		$elt = self::newElementSelect($aattributes);
		$elt -> setAttributes(array(
					'label' => $slabel,
					'name'	=> $sname,
					'value' => $svalue,
					'style' => $sstyle
				));
		$elt -> setOptions($aoptions);
		return $this -> addElement($elt);
	}
	
	public function addSubmit($sname = '__submit', $svalue = "Valider", $fevent = null, $slabel = null, $sstyle = null, $aattributes = array())
	{
		$elt = self::newElementInput($aattributes);
		$elt -> setAttributes(array(
					'type'	=> FORM_ELEMENT_SUBMIT,
					'label' => $slabel,
					'value'	=> $svalue,
					'name'	=> $sname,
					'style' => $sstyle
				));
		$elt = $this -> addElement($elt);
		if(!is_null($fevent))
		{
			$this -> setSubmitEvent($sname, $fevent);
		}
		return $elt;
	}

	public function addButton($sname, $svalue, $aattributes = array())
	{
		$elt = self::newElementInput($aattributes);
		$elt -> setAttributes(array(
					'type'	=> FORM_ELEMENT_BUTTON,
					'value'	=> $svalue,
					'name'	=> $sname
				));
		return $this -> addElement($elt);
	}
	
	public function setSubmitEvent($ssubmitName, $sevent = null)
	{
		if(!isset($this -> elements[$ssubmitName]))
		{
			throw new exception(E_FORM_ELEMENT_UNKOWN);
		}
		if(is_null($sevent))
		{
			unset($this -> _aevents['submit'][$ssubmitName]);
		} else {
			$this -> _aevents['submit'][$ssubmitName] = $sevent;
		}
	}
	/**
	 * 
	 */
	public function addText($sname, $slabel, $svalue = null, $imaxlength = null, $isize = null, $aattributes = array())
	{
		$oelt = $this -> addElementInput(array(
							"type" => FORM_ELEMENT_TEXT,
							"label"=> $slabel,
							"name" => $sname,
							"value"=> $svalue,
							"size" => $isize,
							"maxlength" => $imaxlength
							));
		$oelt -> setAttributes($aattributes);
		return $oelt;
	}
	
	public function addDatePicker($sname, $slabel, $svalue = null, $aattributes = array())
	{
		
		$oelt = $this -> addText($sname, $slabel, $svalue, 10, 10, $aattributes);
		$class = 'class';
		$oelt -> $$class = ' datepicker';
		return $oelt;
	}
	
	public function addSeparator($svalue = null, $aattributes = array())
	{
		static $icount = 0;
		$oelt = $this -> addElement(self::newSeparator(array("name" => "sep_".$icount++, "value" => $svalue)));
		$oelt -> setAttributes($aattributes);
		return $oelt;
	}

	public function addFile($sname, $slabel, $svalue = null, $smaxlength = null, $saccept = null, $aattributes = array())
	{
		$this -> attributes -> enctype = "multipart/form-data";
		if(!is_null($smaxlength))
		{
			$this -> addHidden("MAX_FILE_SIZE", $smaxlength);
		}
		$oelt = $this -> addElementInput(array(
							"type" => FORM_ELEMENT_FILE,
							"label"=> $slabel,
							"name" => $sname,
							"value"=> $svalue,
							"accept" => $saccept
							));
		$oelt -> setAttributes($aattributes);
		return $oelt;
	}

	public function addTextArea($sname, $slabel, $svalue = null, $mcols = '100%', $mrows = 10, $aattributes = array())
	{
		$oelt = $this -> addElement(self::newElementTextArea(array(
							"label"=> $slabel,
							"name" => $sname,
							"value"=> $svalue,
							"cols" => $mcols,
							"rows" => $mrows
							)));
		$oelt -> setAttributes($aattributes);
		return $oelt;
	}

	public function addPassword($sname, $slabel, $svalue = null, $isize = null, $imaxlength = null, $aattributes = array())
	{
		$oelt = $this -> addElementInput(array(
							"type" => FORM_ELEMENT_PASSWORD,
							"label"=> $slabel,
							"name" => $sname,
							"value"=> $svalue,
							"size" => $isize,
							"maxlength" => $imaxlength
							));
		$oelt -> setAttributes($aattributes);
		return $oelt;
	}

	public function addCheckBox($sname, $slabel, $svalue = null, $bchecked = false, $scaption = null, $aattributes = array())
	{
		$oelt = $this -> addElementInput(array(
							"type"    => FORM_ELEMENT_CHECKBOX,
							"label"   => $slabel,
							"name"    => $sname,
							"value"	  => $svalue,
							"after"	  => $scaption,
							"checked" => ($bchecked?"CHECKED":null)
							));
		$oelt -> setAttributes($aattributes);
		return $oelt;
	}

	public function addRadio($sname, $svalue, $slabel, $aattributes = array())
	{
		if(!isset($this -> elements[$sname]))
		{
			$oelt = $this -> addElementRadioGroup(array(
							"label"   => $slabel,
							"name"    => $sname,
							"value"	  => $svalue
							));
		} else {
			$oelt = $this -> elements[$sname];
		}
		$oelt_radio = self::newElementInput(array(
							"type"  => FORM_ELEMENT_RADIO,
							"label" => $slabel,
							"name"  => $sname,
							"value" => $svalue
							));
		$oelt_radio -> setAttributes($aattributes);
		$oelt -> addElement($oelt_radio);
		return $oelt_radio;
	}

	public function addElements($aelements)
	{
		foreach($aelements as $elt)
		{
			switch($elt["type"])
			{
				case FORM_ELEMENT_SELECT  : $elt = $this -> newElementSelect($elt); break;
				case FORM_ELEMENT_TEXTAREA: $elt = $this -> newElementTextarea($elt); break;
				default: $elt = $this -> newElementInput($elt); break;	
			}
			$this -> addElement($elt);
		}
	}

	private function __setFrozen($sname)
	{
		if(!isset($this -> elements[$sname]))
		{
			throw new exception(E_FORM_ELEMENT_UNKOWN);
		}
		$this -> elements[$sname] -> freeze();
	}

	public function setFrozen($mnames)
	{
		if(is_array($mnames))
		{
			foreach($mnames as $name)
			{
				$this -> __setFrozen($name);
			}
		} else {
			$this -> __setFrozen($mnames);
		}
	}
	
	public function freeze($bfrozen = true)
	{
		$this -> _bfrozen = $bfrozen;
	}
	
	public function toArray($bvalidate = true) 
	{
		if($bvalidate) 
		{
			$this -> validate();
		}
		$ary = array();
		$ary['attributes'] = $this -> attributes -> getAttributes(true);
		foreach($this -> elements as $elt)
		{
			if($this -> _bfrozen)
			{
				$elt -> freeze();
			}
			$ary['elements'][$elt -> name] = $elt -> toArray('attributes');
		}
		$ary['errors']  = $this -> getErrors();
		$ary['rules']   = $this -> getRules();
		$ary['title']   = $this -> getTitle();
		$ary['groupList'] = $this -> getGroupList();
		$ary['frozen']  = $this -> _bfrozen;
		return $ary;	
	}

	private function __setRequired($sname, $brequired)
	{
		//$this -> elements[$sname] -> setRequired($brequired);
		if($brequired)
		{
			$this -> addRule('required', $sname);
		} else {
			$this -> removeRule('required', $sname);
		}				
	}

	public function setRequired($mnames, $brequired = true)
	{
		if(is_array($mnames))
		{
			foreach($mnames as $name)
			{
				$this -> __setRequired($name, $brequired);
			}
		} else {
			$this -> __setRequired($mnames, $brequired);
		}
	}
	
	public function required()
	{
		$this -> setRequired(func_get_args());
	}
	
	public function addError($merror, $sname = 'form')
	{
		if(!isset($this -> _aerrors[$sname]) || !in_array($merror, $this -> _aerrors[$sname]))
		{
			$this -> _aerrors[$sname][] = $merror;
		}
	}

	public function elementExist($sname)
	{
		return isset($this -> elements[$sname]);
	}
	
	public function &getElement($sname)
	{
		return $this -> elements[$sname];
	}
	
	public function &getElements()
	{
		return $this -> elements;
	}
	
	public function getNbElements()
	{
		return count($this -> elements);
	}

	protected function _checkIfExistElement($sname)
	{
		if(!isset($this -> elements[$sname]))
		{
			throw new exception(E_FORM_ELEMENT_UNKOWN);
		}	
	}

	public function addRule($srule, $sname)
	{
		$this -> _checkIfExistElement($sname);
		if(!class_exists($srule.'FormRule'))
		{
			throw new exception(E_FORM_RULE_UNKOWN);
		}
		$this -> _arules[$sname][$srule] = 1;
	}
	
	public function removeRule($srule, $sname)
	{
		unset($this -> _arules[$sname][$srule]);
	}
	
	public function getRules()
	{
		return $this -> _arules;
	}

	public function getErrors()
	{
		return $this -> _aerrors;
	}
	
	public function isRequired($sname)
	{
		return isset($this -> _arules[$sname]['required']);
	}

	protected function _setDefaultValue($sname, $svalue, $bstrict = true)
	{
		if($bstrict)
		{
			$this -> _checkIfExistElement($sname);
		}
		if($bstrict || isset($this -> elements[$sname]))
		{
			$oelt = $this -> elements[$sname];
			$oelt -> setValue(request::get($oelt -> name, $svalue, $this -> formatRequestFunction));
		}
	}

	public function setDefaultValue($mnames, $svalue = null)
	{
		if(is_array($mnames))
		{
			if(is_null($svalue))
			{
				foreach(array_keys($mnames) as $skey)
				{
					$this -> _setDefaultValue($skey, $mnames[$skey], false);
				}
			} else {
				foreach($mnames as $skey)
				{
					$this -> _setDefaultValue($skey, $svalue, false);
				}
			}
		} else {
			$this -> _setDefaultValue($mnames, $svalue, true);
		}
	}
	
	public function isValid()
	{
		if(is_null($this -> _bvalid))
		{
			$this -> validate();
		}
		return $this -> _bvalid;
	}
	
	public function validated()
	{
		return $this -> _bvalidated;
	}

	public function countErrors()
	{
		return count($this -> _aerrors);
	}
	
	/**
	 * Alias de synchronize()
	 * 
	 */
	public function setFrom($avalues)
	{
		$this -> synchronize(null, $avalues);
	}
	
	public function synchronize($oelement = null, $ary = null)
	{
		if(is_null($ary))
		{
			$ary = $_REQUEST;
		}
		if(!is_null($oelement) && is_object($oelement))
		{
			if(!$oelement instanceof inputFormElement  || !in_array($oelement -> type, array(FORM_ELEMENT_RADIO, FORM_ELEMENT_CHECKBOX)))
			{
				$oelement -> setValue(ary::get($ary, $oelement -> name, $oelement -> value, $this -> formatRequestFunction));
			} else {
				if(request::exist($oelement -> name))
				{
					$oelement -> check(ary::get($ary, $oelement -> name, null, $this -> formatRequestFunction) == $oelement -> value);
				}
			}
			return;
		}
		foreach($this -> elements as $name => &$oelement)
		{
			$this -> synchronize($oelement, $ary);
		}
	}
	
	public function clear(&$oelement = null)
	{
		if(!is_null($oelement) && is_object($oelement))
		{
			if(!$oelement instanceof inputFormElement  || !in_array($oelement -> type, array(FORM_ELEMENT_BUTTON, FORM_ELEMENT_HIDDEN, FORM_ELEMENT_SUBMIT, FORM_ELEMENT_RESET, FORM_ELEMENT_RADIO, FORM_ELEMENT_CHECKBOX)))
			{
				$oelement -> setValue("");
			} else {

			}
			return;
		}
		foreach($this -> elements as $name => &$oelement)
		{
			$this -> clear($oelement);
		}
	}
	
	public function clearElements()
	{
		$this -> elements = array();
	}
	
	public function validate()
	{
		if($this -> getNbElements() == 0)
		{
			return false;
		}
		$this -> _aerrors = array();
		
		foreach(array_keys($this -> _arules) as $name)
		{
			foreach(array_keys($this -> _arules[$name]) as $rule)
			{
				$validate  = true; $id = null;
				$classRule = $rule.'FormRule';
				if(class_exists($classRule))
				{
					eval('$validate = '.$classRule.'::validate($this -> elements[$name]);');
					if(!$validate)
					{
						eval('$id = '.$classRule.'::getRuleId();');
						$this -> addError($id, $name);
					}
				}
			}
		}
		
		$this -> _bvalid = $this -> countErrors() == 0;
	
		if(!empty($this -> _aevents))
		{
			foreach(array_keys($this -> _aevents['submit']) as $sname)
			{
				if(request::is_set($sname))
				{
					dw::doCallBackFunction($this -> _aevents['submit'][$sname], $this);
				}
			}
		}
		
		$this -> _bvalidated = $this -> _bvalid;

		return $this -> _bvalid;
	}
	
	public function getValue($sname)
	{
		if(!isset($this -> elements[$sname]))
		{
			throw new exception(E_FORM_ELEMENT_UNKOWN);
		}
		return request::get($sname, null);
	}
		
}


?>