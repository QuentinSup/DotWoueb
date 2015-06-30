<?php

namespace dw\classes;

class dwObject {
	protected $_dontExportAttributes = array("_dontExportAttributes");
	
	public function __construct($aattributes = array())
	{
		$this -> setAttributes($aattributes);
	}
	
	public function dontExport($mattr)
	{
		if(is_array($mattr))
		{
			foreach($mattr as $sattr)
			{
				$this -> _dontExportAttributes[] = $sattr;
			}
		} else {
			$this -> _dontExportAttributes[] = $mattr;
		}
	}
	
	public function setAttributes($aAttributes)
	{
		foreach($aAttributes as $key => $value)
		{
			$this -> $key = $value;
		}	
	}
		
	public function toArray()
	{
		$ary = $this -> getAttributes();
		foreach(array_keys($ary) as $var)
		{
			if(is_array($ary[$var]))
			{
				foreach($ary[$var] as &$val)
				{
					if(is_object($val) && (get_class($val) == __CLASS__ || is_subclass_of($val, __CLASS__)))
					{
						$val = $val -> toArray();
					}	
				}
			} else {
				if(is_object($this -> $var) && (get_class($this -> $var) == __CLASS__ || is_subclass_of($this -> $var, __CLASS__)))
				{
					$ary[$var] = $this -> $var -> toArray();	
				}
			}

		}
		return $ary; 
	}
		
	public function getAttributes()
	{
		$ary = array();
		$aAttributes = get_object_vars($this);
		foreach(array_keys($aAttributes) as $attr)
		{
			if(!($attr == '_dontExportAttributes')
			&& isset($this -> $attr) 
			&& !is_null($this -> $attr) 
//			&& !is_array($this -> $attr) 
//			&& !is_object($this -> $attr) 
			&& !in_array($attr, $this -> _dontExportAttributes))
			{
				$ary[$attr] = $this -> $attr;
			}	
		}
		return $ary;
	}
	
	public function isDefined($sattribute)
	{
		$aAttributes = get_object_vars($this);
		return in_array($sattribute, array_keys($aAttributes), true);
	}

	public function isNull($sattribute)
	{
		return !$this -> isDefined($sattribute) || is_null($this -> $sattribute);
	}

	public function isEmpty($sattribute = null)
	{
		if(is_null($sattribute)) {
			return count($this -> getAttributes()) == 0;
		}
		return !$this -> isDefined($sattribute) || empty($this -> $sattribute);
	}
	
}

abstract class dwHTMLTag extends dwObject {
	public $id   	 = null;
	public $style	 = null;
	public $class	 = null;
	protected $tag   = '';
	
	public function __construct($aattributes = array())
	{
		parent::__construct($aattributes);
		$this -> dontExport('tag');
	}
	
	public static function attributesToString($aAttributes)
	{
		$ary = array();
		foreach(array_keys($aAttributes) as $key)
		{
			$ary[$key] = $key.'="'.str_replace('"', '\"', $aAttributes[$key]).'"';
		}
		return implode(" ", $ary);
	}

	public function getAttributes($basString = false)
	{
		$ary = parent::getAttributes();
		if($basString)
		{
			return self::attributesToString($ary);
		} else {
			return $ary;
		}
	}

	public function toArray($skeyAttributes = null)
	{
		$ary = parent::toArray($skeyAttributes);
		if(!is_null($skeyAttributes))
		{
			$ary[$skeyAttributes] = $this -> getAttributes(true);
		}
		return $ary; 
	}
	
}

?>