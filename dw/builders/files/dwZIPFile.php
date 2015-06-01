<?php

/**
 * dwZipFile
 * Créer des archives au format ZIP
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

include_ext('ziplib/zip');
include_al('dwString');

class dwZipFile extends zipfile
{
	public $filename    = null;
  	private $icountfile = 0;
  
  	/**
  	 * Constructeur
  	 * @param string $sfilename Nom de l'archive
  	 */
  	public function __contruct($sfilename = null) {
  		$this -> setFileName($sfilename);
    	$this -> icountfile= 0;
  	}
  	
  	/**
  	 * Définit la valeur de l'attribut $filename
  	 * @param string $sfilename nom du fichier
  	 */
  	public function setFileName($sfilename = null)
  	{
  		if(is_null($sfilename))
  		{
  			$this -> filename = dwString::generate();	
  		} else {
  			$this -> filename = $sfilename;		
  		}
  	}
  
  	/**
  	 * Ajoute un fichier à l'archive
  	 * @param string $sfilename nom du fichier
  	 * @param string $salias nom du fichier dans l'archive
  	 */
 	public function addfile($sfilename, $salias = null) {
  		$scontent = file_get_contents($sfilename);
    	$this -> addcontent($scontent, (is_null($salias)?$sfilename:$salias));
    	return true;
  	}
  	
  	public function addcontent($scontent, $filename = null)
  	{
  		parent::addfile($scontent, $filename);		
  		$this -> icountfile++;
  	}

	/**
	 * Enregistrer le fichier archive
	 * @param string $sfilename Nom de l'archive
	 */
	public function save($sfilename = null) {
		if(!is_null($sfilename))
		{
			$this -> filename = $sfilename;	
		}
		file_put_contents($this -> filename, $this -> file());
	  	return $this -> filename;
	}

}

?>