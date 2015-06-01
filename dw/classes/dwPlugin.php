<?php

namespace dw\classes;

/**
 * Interface de base pour impl魥nter des Plug-Ins dans le framework
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */
 
interface dwPluginInterface 
{
	public function install();
	public function uninstall();
	public function prepare();
}

abstract class dwPlugin extends dwXMLConfig implements dwPluginInterface
{
	protected $_sroot;
	public function install() {}
	public function uninstall() {}
	public function prepareHTML($aparams = null) {}
	public function terminateHTML($aparams = null) {}
	public function prepareRequest($aparams = null) {}
	public function terminateRequest($aparams = null) {}
	
	public function __construct($sname = null)
	{
		$this -> _name = $sname;
	}
	
	public function root()
	{
		return $this -> _sroot;
	}
	
	public function prepare($curPath = null, $sXml = 'ufo.xml', $sencoding = 'ISO-8859-1') 
	{
		 $this -> _sroot = $curPath.'/';
		 $this -> loadConfig($curPath.'/', $sXml, $sencoding);
	}
		
}

abstract class dwSmartyPlugin extends dwPlugin 
{
	abstract public function Smarty();
}

abstract class dwRendererPlugin extends dwPlugin
{
	public static $themeFolder = "themes/";
	public static $defaultTheme = "default";

	public function getCurrentTheme($bwithExtension = true)
	{
		return (is_null($this -> getVar('theme'))?"default":$this -> getVar('theme')).($bwithExtension?".css":"");
	}
	
	public function getThemeFolder()
	{
		return self::$themeFolder.$this -> getCurrentTheme(false)."/";
	}
	
	public function getThemeDir()
	{
		return $this -> root().self::getThemeFolder();
	}
	
	public function prepare($curPath = null, $sXml = 'ufo.xml', $sencoding = 'ISO-8859-1')
	{
		parent::prepare($curPath, $sXml, $sencoding);
	}
	
	abstract function render($model = null);
}

abstract class dwHTMLRendererPlugin extends dwRendererPlugin 
{
	public function prepare($curPath = null, $sXml = 'ufo.xml', $sencoding = 'ISO-8859-1')
	{
		dw::setHTMLRenderer($this);
		parent::prepare($curPath, $sXml, $sencoding);	
	}	
}
abstract class dwGridRendererPlugin extends dwRendererPlugin {
	public function prepare($curPath = null, $sXml = 'ufo.xml', $sencoding = 'ISO-8859-1')
	{
		dw::setGridRenderer($this);
		parent::prepare($curPath, $sXml, $sencoding);	
	}
	
}
abstract class dwFormRendererPlugin extends dwRendererPlugin 
{
	public function prepare($curPath = null, $sXml = 'ufo.xml', $sencoding = 'ISO-8859-1')
	{
		dw::setFormRenderer($this);
		parent::prepare($curPath, $sXml, $sencoding);	
	}	
}
 
?>