<?php 

namespace dw\classes;

/**
 * dwRequestFile
 * Gère les upload de fichiers par formulaire
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

class dwRequestFile 
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
	
	public function getName() {
		return $this -> name;		
	}
	

	public function save($sdir = ".", $sname = null)
	{
		return move_uploaded_file($this -> tmp_name, $sdir."/".(is_null($sname)?$this -> name:$sname));
	}
	
	/* STATIC */
	
	public static function &factory($fromname)
	{
		$requestFile = new dwRequestFile();
		$file = ary::get($_FILES, $fromname);
		if($file) {
			$requestFile -> fromArray($file);
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
	
}
?>