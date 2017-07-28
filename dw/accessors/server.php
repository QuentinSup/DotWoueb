<?php

namespace dw\accessors;

use dw\accessors\ary;

/**
 * server
 * Gere les valeurs $_SERVER
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

class server
{
	
	/**
	 * Prevent implementation
	 */
	private function __construct() {}

	public static function get($name, $defaultvalue = null, $formatRequestFunction = 'trim')
	{
		return ary::get($_SERVER, $name, $defaultvalue, $formatRequestFunction);
	}
	
	public static function set($name, $mvalue)
	{
		ary::set($_SERVER, $name, $mvalue);
	}

	/**
	 * Renvoi si le nom passe en parametre possede une valeur dans $_REQUEST
	 * @param string $sname
	 * @see is_set
	 */
	public static function is_set($sname)
	{
		return ary::is_set($_SERVER, $sname);
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

}