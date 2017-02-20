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
 * Manager interceptors
 * Interceptor are classes which intercept HTTP request before and after being threated by a controller
 * @author QuentinSup
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
	
	/**
	 * Returne all interceptors list
	 * @return unknown
	 */
	public static function getInterceptors()
	{
		return self::$_aLoaded;	
	}
	
	/**
	 * Return a load interceptor
	 * Throw an exception is the interceptor is not loaded
	 * @param $sname name of the interceptor
	 * @throws dwException
	 * @return unknown
	 */
	public static function getInterceptor($sname)
	{
		if(!self::isLoaded($sname))
		{
			throw new dwException(E_LISTENER_UNKNOW);
		}
		return self::$_aLoaded[$sname];
	}
	
	/**
	 * Return true if the interceptor has been loaded
	 * @param $sname name of the interceptor
	 * @return unknown
	 */
	public static function isLoaded($sname)
	{
		return isset(self::$_aLoaded[$sname]);
	}
	
	/**
	 * Load an interceptor by his name
	 * The PHP filename must exist with this name into the path directory
	 * @param $sname name of the interceptor
	 * @param string $path The path to find the PHP file
	 * @param boolean $useCache
	 * @throws dwException
	 * @return unknown
	 */
	public static function &loadInterceptor($sname, $path = APP_INTERCEPTORS_DIR, $useCache = true)
	{
		if(is_null($path)) {
			$path = self::$defaultPath;
		}
		if(!isset(self::$_aLoaded[$sname]) || !$useCache) {
			
			if(self::logger() -> isTraceEnabled()) {
				self::logger() -> trace("Load interceptor file '$path.$sname.php'");
			}
			
			// include php file
			include_once($path.$sname.'.php');
			
			// try to find the className into file
			$class = dw::App() -> getNamespace().$sname.self::$suffixClassName;
			
			if(!class_exists($class))
			{
				throw new dwException("Class '$class' for interceptor '$sname' doesn't exist");	
			} else {
				
				// Create an instance and check heritage
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
	 
	/**
	 * Load one or multiple interceptors
	 * @param mixed $interceptors could be the name of an interceptor to load, or a list of names
	 * @param string $path
	 * @param boolean $useCache
	 * @return unknown
	 */
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
	
	/**
	 * Do a function for all interceptors loaded
	 * @param unknown $sfunction
	 * @param dwHttpRequest $request
	 * @param dwHttpResponse $response
	 * @param dwModel $model
	 * @return boolean
	 */
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