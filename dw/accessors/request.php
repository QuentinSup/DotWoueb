<?php

namespace dw\accessors;

use dw\accessors\ary;

/**
 * request
 * G貥 les valeurs $_REQUEST
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

class request
{

	public static function get($name, $defaultvalue = null, $formatRequestFunction = 'trim')
	{
		return ary::get($_REQUEST, $name, $defaultvalue, $formatRequestFunction);
	}
	
	public static function set($name, $mvalue)
	{
		ary::set($_REQUEST, $name, $mvalue);
	}

	/**
	 * Renvoi si le nom passe en parametre possede une valeur dans $_REQUEST
	 * @param string $sname
	 * @see is_set
	 */
	public static function is_set($sname)
	{
		return ary::is_set($_REQUEST, $sname);
	}
	
	/**
	 * Alias de is_set
	 * @param string $sname
	 * @see is_set
	 */
	public static function exist($sname)
	{
		return self::is_set($sname);
	}
	
	public static function &getRequestFile($name)
	{
		return requestFile::factory($name);
	}

}

/**
 * requestFile
 * G貥 les upload de fichiers par formulaire
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

class requestFile 
{
	public $name = '';
	public $type = '';
	public $size = '';
	public $tmp_name = '';
	
	public function is_uploaded()
	{
		return is_uploaded_file($this -> tmp_name);	
	}
	
	public function fromArray($aattributs)
	{
		$this -> name     = $aattributs['name'];
		$this -> type 	  = $aattributs['type'];
		$this -> size 	  = $aattributs['size'];
		$this -> tmp_name = $aattributs['tmp_name'];				
	}
	
	public function toArray()
	{
		$ary['name']	= $this -> name;
		$ary['type']	= $this -> type;
		$ary['size']	= $this -> size;
		$ary['tmp_name']= $this -> tmp_name;
		return $ary;	
	}
	
	public function isTypeOf($mtype)
	{
		if(is_array($mtype))
		{
			return in_array($this -> type, $mtype);
		}
		return $this -> type == $mtype;
	}
	
	public function getSize()
	{
		return filesize($this -> tmp_name);	
	}
	
	public static function &factory($fromname)
	{
		$requestFile = new requestFile();
		if(isset($_FILES[$fromname]))
		{
			$requestFile -> fromArray($_FILES[$fromname]);
		}
		return $requestFile;
	}
	
	public static function hasUpload()
	{
		return count($_FILES) > 0;
	}

	public static function countUpload()
	{
		return count($_FILES);
	}
	
	public function save($sdir, $sname = null)
	{
		return move_uploaded_file($this -> tmp_name, $sdir."/".(is_null($sname)?$this -> name:$sname));
	}
	
}

?>