<?php 

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