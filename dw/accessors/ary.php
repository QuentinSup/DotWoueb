<?php

namespace dw\accessors;

/**
 * ary (signifie array)
 * Manage an associative array
 * @author QuentinSup
 * @version 1.0
 * @package dotWoueb
 */

class ary
{
	
	/**
	 * Prevent implementation
	 */
	private function __construct() {}
	
	// Static definitions
	
	public static function &get(&$ary, $name, $defaultvalue = null, $formatRequestFunction = null, $autoset = false)
	{
		if($ary) {

			if(is_numeric($name) && is_assoc($ary)) {
				$keys = array_keys($ary);
				if($name < count($keys)) {
					$name = $keys[$name];	
				}
			}
			if(isset($ary[$name]))
			{
				if(!is_array($ary[$name]) && !is_null($formatRequestFunction) && function_exists($formatRequestFunction))
				{
					$ary[$name] = $formatRequestFunction($ary[$name]);
				}
				return $ary[$name];
			} 
		
		}

		if($autoset === TRUE) {
			$ary[$name] = $defaultvalue;
			return $ary[$name];
		}
		
 		return $defaultvalue;
	}
	
	public static function set(&$ary, $name, $mvalue)
	{
		$ary[$name] = $mvalue;
	}
	
	public static function keys($ary) {
		return array_keys($ary);
	}
	
	public static function keyAt($ary, $offset) {
		$keys = array_keys($ary);
		return count($keys)>$offset?$keys[$offset]:null;
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
	public static function exists($ary, $sname)
	{
		return self::is_set($ary, $sname);
	}
	
}