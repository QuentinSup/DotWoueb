<?php

namespace dw\classes\i18n;

use dw\classes\dwI18nInterface;
use dw\classes\dwXMLConfig;

class dwI18nXmlAdapter extends dwXMLConfig implements dwI18nInterface
{
	/** Chemin du r鰥rtoire ou sont stock鳠les fichiers XML */ 
	protected static $_defaultDir     = './';
	protected static $_defaultCaching = true;
	
	/** Tableau des traductions (tag => traduction) */
	protected $_atags = array();
	/** Format utilis頤ans le cadre du d颯guage si la traduction recherch饠n'existe pas */
	public $ferror = null;

	/***************************************************************************
	 * Construit un nouvel objet dwXmlTraducer ࠰artir d'un fichier XML
	 * (contenant les traductions)
	 * @param string $sxml Fichier XML (sans extension) Le fichier est recherch銉 * dans le dossier obtenu par la fonction getPath()
	 * @see getPath
	 * @return dwXmlTraducer
	 ***************************************************************************/
	public static function factory($sxml, $spath = null, $bcaching = null)
	{
		if(is_null($spath))
		{
			$spath = self::$_defaultDir;	
		}
		if(is_null($bcaching))
		{
			$bcaching = self::$_defaultCaching;
		}
		$sxml 	 = strtolower($sxml);
		$scacheID = $spath.$sxml;
		$oxml = null;
		if($bcaching)
		{
			$oxml = dwCacheFile::get($scacheID);
		}
  		if(is_null($oxml))
  		{
			$oxml = new dwXMLTraducer($spath.$sxml.'.xml', $bcaching);
			/* L'objet est gard頥n m魯ire pour une utilisation ult鲩eure */
			if($bcaching)
			{
				dwCacheFile::set($scacheID, $oxml);
			}
  		}
		return $oxml;
	}
	
	/***************************************************************************
	 * D馩ni le chemin ou sont stock鳠les fichiers XML
	 * @param string $stag
	 * @return string
	 ***************************************************************************/
	public static function setDefaultDir($spath)
	{
		self::$_defaultDir = $spath;
	}

	/***************************************************************************
	 * Retourne le chemin ou sont stock鳠les fichiers XML
	 * @return string
	 ***************************************************************************/
	public static function getDefaultDir()
	{
		return self::$_defaultDir;
	}

    public static function setDefaultCaching($bcaching)
    {
    	self::$_defaultCaching = $bcaching;
    }
   
    public static function getDefaultCaching()
    {
    	return self::$_defaultCaching;
    }

	/***************************************************************************
	 * Constructeur de l'objet
	 * @param string $sxmlfilename Nom du fichier Xml
	 ***************************************************************************/
	public function __construct($sxmlfilename)
	{
		$oxml = parent::loadConfig(null, $sxmlfilename);
		if(isset($oxml -> struct) && isset($oxml -> struct -> tag))
		{
			if(is_array($oxml -> struct -> tag))
			{
				foreach($oxml -> struct -> tag as $tag)
				{
					$this -> _atags[strtolower((string)$tag -> name)] = (string)$tag -> cdata;
				}

			} else {
				$this -> _atags[strtolower((string)$oxml -> struct -> tag -> name)] = (string)$oxml -> struct -> tag -> cdata;
			}
		}
		unset($oxml);
	}
	
	/***************************************************************************
	 * Renvoi si un (un plusieurs) tag poss褥 une traduction
	 * @param mixed $mtag Peut 괲e une chaine ou un tableau
	 * @return boolean
	 ***************************************************************************/
	public function exists($mtag)
	{
		return in_array($mtag, array_keys($this -> _atags));
	}
	
	/***************************************************************************
	 * Renvoi la traduction d'un tag
	 * @param string $stag
	 * @return string
	 ***************************************************************************/
	public function get($stag, $sdefaultvalue = null)
	{
		$stag   = strtolower($stag);
		$ferror = $this -> ferror;
		return isset($this -> _atags[$stag])?$this -> _atags[$stag]:(is_null($ferror)?$sdefaultvalue:(function_exists($ferror)?$ferror($sdefaultvalue):sprintf($ferror, $sdefaultvalue)));
	}

	/***************************************************************************
	 * D馩ni la traduction d'un tag
	 * @param string $stag
	 * @param string $svalue
	 * @return void
	 ***************************************************************************/
	public function set($stag, $svalue)
	{
		$this -> _atags[strtolower($stag)] = $svalue;	
	}

	/***************************************************************************
	 * Renvoi le tableau des traductions
	 * @return array
	 ***************************************************************************/
	public function toArray()
	{
		return $this -> _atags;
	}
	
}

?>