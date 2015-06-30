<?php

namespace dw;

define('E_DW_LOAD', -1);

define("DW_ROOT_DIR", dirname(dirname(__FILE__)).'/');
define("DW_WWW_DIR", DW_ROOT_DIR."www/");
define("DW_DEFAULT_ENCODING", "ISO-8859-1");

use dw\connectors\dbi\dbi;
use dw\accessors\server;
use dw\classes\dwException;
use dw\classes\dwLogger;
use dw\classes\AutoLoader;
use dw\classes\dwHttpRequest;

/**
 * Classe principale du framework (toutes les fonctions sont statiques)
 * @author Quentin Supernant
 */
class dwFramework
{
	/**
	 * @var String Nom du framework
	 */
	private static $_name = null;
	/**
	 * @var String Auteur du framework
	 */
	private static $_author = null;
	/**
	 * @var String Version du framework
	 */
	private static $_version = null;
	/**
	 * @var Array Tableau de valeurs extraites du fichier de configuration
	 */
	private static $_vars = array();
	/**
	 * @var String Description du framework
	 */
	private static $_description = null;
	/**
	 * @var String Objet Application charg銉 */
	private static $_application = null;
	/**
	 * @var boolean Utilise ou non le cacheForm
	 */
	private static $_useCacheForm = false;
	private static $_cacheObject = array();
	/**
	 * Autoloader
	 */
	private static $_autoLoader = null;
	/**
	 * Nom du framework
	 */
	public static function getName() 		{ return self::$_name; }
	/**
	 * Description du framework
	 */
	public static function getDescription() { return self::$_description; }
	/**
	 * Auteur du framework
	 */
	public static function getAuthor()		{ return self::$_author; }
	/**
	 * Version du framework
	 */
	public static function getVersion()		{ return self::$_version; }

	public static function DB()
	{
		return dbi::getCurrentConnection();
	}

	public static function isDebug()
	{
		return self::App() -> getRunMode() != "1";
	}

	/**
	 * @deprecated
	 */
	public static function giveActionUrl($saction, $aget = null)
	{
		return 'index.php?action='.$saction.(!is_null($aget)?'&'.http_build_query($aget):'');
	}
	
	
	public static function loadConfig($curPath, $sXml = 'dw.xml', $sencoding = DW_DEFAULT_ENCODING)
	{
	
		$sxml = file_get_contents($curPath.'/'.$sXml);
		$xml = simplexml_load_string($sxml, 'SimpleXMLElement', LIBXML_NOCDATA);
		if(!$xml) 
		{
			throw new exception(E_DW_LOAD);
		}
		if(isset($xml -> about))
		{
			self::$_name		    = (string)$xml -> about -> name;
			self::$_description  	= (string)$xml -> about -> description[0];
			self::$_author 	   		= (string)$xml -> about -> author[0];
			self::$_version 	    = (string)$xml -> about -> version[0];
		}

		$svar = 'var';
		if(isset($xml -> config) && isset($xml -> config -> $svar))
		{
			foreach($xml -> config -> $svar as $var)
			{
				if(isset($var['name']))
				{
					$name = strtoupper((string)$var['name']);
					if(isset($var['value']))
					{
						$value = (string)$var['value'];
					} else {					
						$value = (string)$var;						
					}				
					self::$_vars[$name] = $value;
					if(isset($var['static']) && (int)$var['static'] == 1)
					{				
						if(!defined($name))
						{
							define($name, $value);
						}
					}
				}
			}
		}
	}
	
	public static function clearCacheObject($sid = null)
	{
		if(!is_null($sid))
		{
			self::removeCacheObject($sid);
			return;
		}
		foreach(self::$_cacheObject as $id => $object)
		{
			self::removeCacheObject($id);
		}
	}
	
	public static function updateCacheObject($sid, &$object)
	{
		self::$_cacheObject[$sid] = &$object;
	}

	public static function removeCacheObject($sid)
	{
		unset(self::$_cacheObject[$sid]);
	}
	
	public static function loadApplication($appDir)
	{
		self::$_application = new dwApplication();
		self::$_application -> loadConfig($appDir);
		return self::$_application;
	}
	
	public static function App()
	{
		return self::$_application;
	}
	
	public static function toArray()
	{
		$ary = array(
				"name" => self::$_name, 
				"author" => self::$_author, 
				"version" => self::$_version,
				"description" => self::$_description,
				"vars" => self::$_vars);
		return $ary;	
	}
	
	public static function load()
	{
		self::loadConfig(DW_WWW_DIR);
		
		if(!defined('DW_BASE_DIR'))		    define('DW_BASE_DIR', DW_ROOT_DIR."dw/");
		if(!defined('DW_CONNECTORS_DIR'))	define('DW_CONNECTORS_DIR', DW_BASE_DIR."connectors/");
		if(!defined('DW_VENDORS_DIR')) 		define("DW_VENDORS_DIR", DW_BASE_DIR."vendors/");
		if(!defined('DW_SMARTY_DIR')) 		define("DW_SMARTY_DIR", DW_VENDORS_DIR."Smarty/");

		if(!defined('DW_LISTENERS_DIR'))	define('DW_LISTENERS_DIR', "./listeners/");
		if(!defined('DW_CONTROLLERS_DIR'))  define("DW_CONTROLLERS_DIR", "./controllers/");
		if(!defined('DW_WEBINF_DIR'))		define("DW_WEBINF_DIR", "./web-inf/");
		if(!defined('DW_RUNTIME_DIR'))		define("DW_RUNTIME_DIR", DW_WEBINF_DIR."runtime/");
		if(!defined('DW_CACHE_DIR'))		define("DW_CACHE_DIR", DW_RUNTIME_DIR."cache/");
		if(!defined('DW_TRADUCER_DIR'))		define("DW_TRADUCER_DIR", "./traduce/");
		if(!defined('DW_DBI_ENTITYDEF_DIR'))define("DW_DBI_ENTITYDEF_DIR", "./entity/");
				
		dw_require("classes/dwLogger");
		dw_require("classes/dwAutoLoader");
		self::$_autoLoader = new AutoLoader(array("dw" => DW_BASE_DIR));
		
		// Configure loggers
		dwLogger::configure(DW_WWW_DIR.'log4php.xml');

	}
	
	public static function run(dwHttpRequest $request, $buseDefaultController = true)
	{
		dwFrontController::singleton() -> run($request, DW_CONTROLLERS_DIR, $buseDefaultController);
	}
	
	public static function runAndDie(dwHttpRequest $request, $buseDefaultController = true)
	{
		self::run($request);
		die;
	}
		
	public static function doCallBackFunction($sfunction, $mparams = null, $beval = true)
	{
		if(!is_null($sfunction))
		{
			if(function_exists($sfunction))
			{
				$sfunction($mparams);
			} elseif($beval) {
				eval($sfunction.'($mparams);');
			}
		}
	}
	
	/**
	 * Renvoi la locale courante utilisée à partir de la variable $_SERVER[HTTP_ACCEPT_LANGUAGE] (langue)
	 * @return la langue du navigateur
	 */
	public static function getLocale()
	{
		$locale = explode(",", server::get("HTTP_ACCEPT_LANGUAGE"));
		$locale = strtolower(substr(chop($locale[0]),0,2));
		return $locale;
	}
	
	/**
	 * Renvoi la langue par défaut de l'application
	 * @return La langue définie dans le fichier de configuration
	 */
	public static function getAppLang()
	{
		return self::App() -> getLang();
	}
		
}

?>