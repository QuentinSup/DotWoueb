<?php

namespace dw\accessors;

use dw\accessors\ary;
use dw\classes\dwRequestFile;

/**
 * request
 * G貥 les valeurs $_REQUEST
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

class request
{

	/**
	 * Prevent implementation
	 */
	private function __construct() {}
	
	public static function get($name, $defaultvalue = null, $formatRequestFunction = 'trim')
	{
		$value = ary::get($_REQUEST, $name, $defaultvalue, $formatRequestFunction);
		return is_string($value)?urldecode($value):$value;
	}
	
	public static function set($name, $value)
	{
		$encodedValue = urlencode($value);
		ary::set($_REQUEST, $name, $encodedValue);
		return $encodedValue;
	}
	
	public static function keyAt($offset) {
		return ary::keyAt($_REQUEST, $offset);
	}

	/**
	 * Renvoi si le nom passe en parametre possede une valeur dans $_REQUEST
	 * @param string $sname
	 * @see is_set
	 */
	public static function is_set($sname)
	{
		return ary::is_set($_REQUEST, $sname);
	}
	
	/**
	 * Alias de is_set
	 * @param string $sname
	 * @see is_set
	 */
	public static function exist($sname)
	{
		return self::is_set($sname);
	}
	
	public static function &getRequestFile($name)
	{
		return dwRequestFile::factory($name);
	}

}