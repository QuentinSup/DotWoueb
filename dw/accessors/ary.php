<?php

namespace dw\accessors;

/**
 * ary (signifie array)
 * G貥 les valeurs d'un tableau associatif
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

class ary
{

	public static function get($ary, $name, $defaultvalue = null, $formatRequestFunction = null)
	{
		if(isset($ary[$name]))
		{
			if(!is_array($ary[$name]) && !is_null($formatRequestFunction) && function_exists($formatRequestFunction))
			{
				$ary[$name] = $formatRequestFunction($ary[$name]);
			}
			return $ary[$name];
		} 
		return $defaultvalue;
	}
	
	public static function set(&$ary, $name, $mvalue)
	{
		$ary[$name] = $mvalue;
	}

	/**
	 * Renvoi si le nom passe en parametre possede une valeur dans $ary
	 * @param string $sname
	 * @see is_set
	 */
	public static function is_set($ary, $sname)
	{
		return isset($ary[$sname]);
	}
	
	/**
	 * Alias de is_set
	 * @param string $sname
	 * @see is_set
	 */
	public static function exist($ary, $sname)
	{
		return self::is_set($ary, $sname);
	}
	
}