<?php

namespace dw\classes;

/**
 * dwError
 * Contient la description d'une erreur
 * @author Quentin Supernant
 * @package dotWoueb
 */

class dwError
{
	protected $_ierrno;
	protected $_serrstr;
	protected $_serrfile;
	protected $_ierrline;
	
	/**
	 * Constructeur
	 * @param int $ierrno Num鲯 de l'erreur
	 * @param string $serrstr Description de l'erreur
	 * @param string $serrfile Fichier g鮩rant l'erreur
	 * @param int $ierrline Ligne dans le fichier
	 */
	public function __construct($ierrno, $serrstr, $serrfile, $ierrline)
	{
		$this -> _ierrno   	= $ierrno;
		$this -> _serrstr   = $serrstr;
		$this -> _serrfile	= $serrfile;
		$this -> _ierrline  = $ierrline;
	}
	
	/**
	 * getErrMsg()
	 * @return string La description de l'erreur
	 */
	public function getErrMsg()
	{
		return $this -> _serrstr; 	
	}
	
	/**
	 * getErrNo()
	 * @return int Le num鲯 de l'erreur
	 */
	public function getErrNo()
	{
		return $this -> _ierrno;	
	}
	
	/**
	 * getErrFile()
	 * @return string Le fichier contenant l'erreur
	 */
	public function getErrFile()
	{
		return $this -> _serrfile;	
	}
	
	/**
	 * getErrLine()
	 * @return string La ligne du fichier contenant l'erreur
	 */
	public function getErrLine()
	{
		return $this -> _ierrline;	
	}
	
	/**
	 * raise
	 * Affiche sommairement l'erreur ࠬ'飲an (utilise var_dump)
	 * @param object $oerror L'objet erreur
	 */
	public static function raise($oerror)
	{
		//var_dump($oerror -> toArray());
		echo "<b>".$oerror -> getErrNo()." : </b>".$oerror -> getErrMsg()." dans le fichier ".$oerror -> getErrFile()." (Ligne <b>".$oerror -> getErrLine()."</b>)<br />";
	}
	
	/**
	 * toArray()
	 * @return array Le tableau de valeurs de l'erreur
	 */
	public function toArray() 
    {
    	return array(
    		"MESSAGE" => $this -> getErrMsg(),
    		"NO"	  => $this -> getErrNo(),
    		"FILE"	  => $this -> getErrFile(),
    		"LINE"	  => $this -> getErrLine()
    	);
    
    }
    	
}

?>