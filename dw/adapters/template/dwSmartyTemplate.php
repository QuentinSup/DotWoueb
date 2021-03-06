<?php

namespace dw\adapters\template;

require_once(DW_SMARTY_DIR."Smarty.class.php");

/**
 * Gestion des templates
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */
class dwSmartyTemplate extends \Smarty
{
	protected static $_workDir = './';
	protected static $_defaultCaching = false;
	
	/**
	 * 
	 * @param unknown $dir_tpl
	 * @param unknown $bcaching
	 * @return \dw\adapters\template\dwSmartyTemplate
	 */
	public static function &factory($dir_tpl = null, $bcaching = null)
	{
		return new self($dir_tpl, $bcaching);
	}
	
	/**
	 * 
	 * @param unknown $sview
	 * @param array $amodel
	 * @return unknown
	 */
	public static function renderize($sview, $amodel = array())
	{
		$tpl = new self();
		$tpl -> assign($amodel);
		return $tpl -> render($sview);
	}
	
	/**
	 * __construct()
	 * initialise la librairie Smarty et les dossiers utilises
	 * @param string $dir_tpl dossier contenant les templates
	 * @param bool $bcaching utilise le cache ou non
	 */
	public function __construct($dir_tpl = null, $bcaching = null)
	{
		parent::__construct();
		if(is_null($dir_tpl))
		{
			$dir_tpl = self::$_workDir;
		}
		if(is_null($bcaching))
		{
			$bcaching = self::$_defaultCaching;
		}
		$this->template_dir = '';
		$this->compile_dir  = $dir_tpl."templates_c/";
		$this->config_dir   = $dir_tpl."config/";
		$this->cache_dir    = $dir_tpl."cache/";
		$this->caching		= $bcaching;
	}
	
    /**
     * render()
     * Calcul et retourne le resultat du fichier modele 
     * @param string $stemplate_name le nom du fichier modele
     * @return string le code html
     */
    public function render($stemplate_name)
    {
    	return $this -> fetch($stemplate_name);
    }
    
    public static function setWorkDir($sdir)
    {
    	self::$_workDir = $sdir;
    }
   
    public static function getWorkdir()
    {
  	 	return self::$_workDir;
    }
   
    public static function setDefaultCaching($bcaching)
    {
    	self::$_defaultCaching = $bcaching;
    }
   
    public static function getDefaultCaching()
    {
    	return self::$_defaultCaching;
    }
    
}