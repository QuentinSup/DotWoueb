<?php

namespace dw;

use dw\classes\dwHttpRequest;
use dw\classes\dwHttpResponse;
use dw\classes\dwModel;

define('E_PLUG_LOAD', 100);
define('E_PLUG_UNKNOW', 101);

/**
 * Classe pour gérer les plugins
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */
class dwPlugins {
	
	public static $pathPlugins = './';
	public static $pluginSuffix = '';
	private static $_aPluginLoaded = array();
	 
	public static function getPlugins()
	{
		return self::$_aPluginLoaded;	
	}
	
	public static function getPlugin($splugin)
	{
		if(!self::isLoaded($splugin))
		{
			throw new \Exception(E_PLUG_UNKNOW);
		}
		return self::$_aPluginLoaded[$splugin];
	}
	
	public static function isLoaded($splugin)
	{
		return isset(self::$_aPluginLoaded[$splugin]);
	}
	
	public static function &loadPlugin($splugin, $pathPlugins, $useCache = true)
	{
		if(!isset(self::$_aPluginLoaded[$splugin]) || !$useCache)
		{
			include_once($pathPlugins.'/'.$splugin.'/'.$splugin.'.php');
			$class = $splugin.self::$pluginSuffix;
			if(class_exists($class))
			{
				$plugin = new $class($splugin);
				$plugin -> prepare($pathPlugins.'/'.$splugin);
				self::$_aPluginLoaded[$splugin] = $plugin;
			} else {
				throw new \Exception(E_PLUG_LOAD);	
			}
		}
		return self::$_aPluginLoaded[$splugin];	
	}
	 
	public static function load($mplugin, $pathPlugins = null, $useCache = true)
	{
		if(is_null($pathPlugins))
		{
			$pathPlugins = self::$pathPlugins;
		}
		if(is_array($mplugin))
		{
			foreach($mplugin as $splugin)
			{
				self::loadPlugin($splugin, $pathPlugins, $useCache);	
			}
		} else {
			return self::loadPlugin($mplugin, $pathPlugins, $useCache);		
		}
	}
	
	public static function forAllPluginsDo($sfunction, dwHttpRequest $request, dwHttpResponse $response, dwModel $model)
	{
		foreach(self::$_aPluginLoaded as $plugin)
		{
			$plugin -> $sfunction($request, $response, $model);
		}
	}
	
	public static function setPath($spath)
	{
		self::$pathPlugins = $spath;
	}
		
}