<?php

namespace dw;

use dw\dwFramework as dw;
use dw\classes\dwLogger;
use dw\classes\dwException;
use dw\classes\dwHttpRequest;
use dw\classes\dwHttpResponse;
use dw\classes\dwModel;

define('E_LISTENER_UNKNOW', 101);

/**
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */
class dwInterceptors {
	
	public static $defaultPath = './';
	public static $suffixClassName = '';
	private static $_aLoaded = array();
	 
	// Logger
	private static function logger() {
		static $logger = null;
		if(is_null($logger)) {
			$logger = dwLogger::getLogger(__CLASS__);
		}
		return $logger;
	}
	
	public static function getInterceptors()
	{
		return self::$_aLoaded;	
	}
	
	public static function getInterceptor($sname)
	{
		if(!self::isLoaded($sname))
		{
			throw new dwException(E_LISTENER_UNKNOW);
		}
		return self::$_aLoaded[$sname];
	}
	
	public static function isLoaded($sname)
	{
		return isset(self::$_aLoaded[$sname]);
	}
	
	public static function &loadInterceptor($sname, $path = APP_INTERCEPTORS_DIR, $useCache = true)
	{
		if(is_null($path)) {
			$path = self::$defaultPath;
		}
		if(!isset(self::$_aLoaded[$sname]) || !$useCache) {
			
			if(self::logger() -> isTraceEnabled()) {
				self::logger() -> trace("Load interceptor file '$path.$sname.php'");
			}
			
			include_once($path.$sname.'.php');
			$class = dw::App() -> getNamespace().$sname.self::$suffixClassName;
			
			if(!class_exists($class))
			{
				throw new dwException("Class '$class' for interceptor '$sname' doesn't exist");	
			} else {
				$listener = new $class($sname);
				if(!is_subclass_of($listener, "dw\classes\dwInterceptorInterface")) {
					throw new dwException("Class '$class' for interceptor '$sname' is not a subclass of dw\classes\dwInterceptorInterface");	
				} else {
					$listener -> init();
					self::$_aLoaded[$sname] = $listener;
				}
			}
		}
		return self::$_aLoaded[$sname];	
	}
	 
	public static function &load($interceptors, $path = APP_INTERCEPTORS_DIR, $useCache = true)
	{
		if(is_array($interceptors))
		{
			foreach($interceptors as $sname)
			{
				self::load($sname, $path, $useCache);	
			}
		} else {
			return self::loadInterceptor($interceptors, $path, $useCache);		
		}
	}
	
	public static function forAllInterceptorsDo($sfunction, dwHttpRequest $request, dwHttpResponse $response, dwModel $model)
	{
		foreach(self::$_aLoaded as $interceptor)
		{
			if($interceptor -> $sfunction($request, $response, $model) === false) {
				return false;
			}
		}
		return true;
	}
		
}
 
?>