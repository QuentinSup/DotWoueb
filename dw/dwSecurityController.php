<?php 

namespace dw;

use dw\helpers\dwArray;
use dw\classes\dwHttpRequest;
use dw\classes\dwHttpResponse;
use dw\classes\dwException;

class dwSecurityController {
	
	private static $_methods;
	private static $_adapters;
	
	public static function init() {
		self::$_methods = new dwArray();
		self::$_adapters = new dwArray();
	}
	
	/**
	 * 
	 * @param unknown $name
	 * @param unknown $class
	 * @param unknown $config
	 */
	public static function loadAdapter($name, $class, $config) {
		
		$adapter = new $class();
		
		if(!is_subclass_of($adapter, 'dw\classes\dwSecurityAdapterInterface')) {
			throw new dwException("'$class' must inherits dw\classes\dwSecurityAdapterInterface");
		}

		$adapter -> prepare($config);
		self::$_adapters -> set(strtolower($name), $adapter);

	}
	
	/**
	 * 
	 * @param unknown $annotation
	 * @param unknown $class
	 * @param unknown $method (optional, default is null)
	 */
	public static function watch($annotation, $class, $method = null) {
		$key = $class."::".$method;
		
		$ary = &self::$_methods -> getA($key, array());
		
		$adapterName = $annotation -> getValue();
		
		if(!$adapterName) {
			$adapterName = 'basic';
		}

		$adapter = self::$_adapters -> get($adapterName);
		
		if(!$adapter) {
			throw new dwException("Security adapter '$adapterName' is not defined");
		}
		
		$ary[] = $adapter;

	}
	
	/**
	 * 
	 * @param unknown $class
	 * @param unknown $method
	 * @return boolean
	 */
	public static function access($class, $method, dwHttpRequest $request, dwHttpResponse $response) {
		$adapters = self::$_methods -> get($class."::", array());
		$adapters = $adapters + self::$_methods -> get($class."::".$method, array());

	
		foreach($adapters as $adapter) {

			if($adapter -> control($request, $response) === FALSE) {
				return false;
			}
		}
		
		return true;
	}
		
}

?>