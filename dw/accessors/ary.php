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
				if(!is_array($ary[$name]) && !is_null($formatRequestFunction) && is_callable($formatRequestFunction))
				{
					$ary[$name] = call_user_func($formatRequestFunction, $ary[$name]);
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
		return $ary;
	}
	
	public static function push(&$ary, $values) 
	{
		foreach($values as $key => $value) {
			ary::set($ary, $key, $value);
		}
	}
	
	/**
	 * Return a ste of keys
	 * @param unknown $ary
	 * @return unknown
	 */
	public static function keys($ary) 
	{
		return array_keys($ary);
	}
	
	/**
	 * Return the key at an offset position
	 * @param unknown $ary
	 * @param unknown $index
	 * @return NULL|unknown
	 */
	public static function keyAt($ary, $index) 
	{
		$keys = array_keys($ary);
		return count($keys)>$index?$keys[$index]:null;
	}

	/**
	 * Renvoi si le nom passe en parametre possede une valeur dans $ary
	 * @param string $index
	 * @see exists
	 */
	public static function is_set($ary, $index)
	{
		return isset($ary[$index]);
	}
	
	/**
	 * Alias de is_set
	 * @param string $value
	 * @see is_set
	 */
	public static function exists($ary, $value)
	{
		if(is_assoc($ary)) {

			return self::is_set($ary, $value);
		}
		return in_array($value, $ary, false);
	}
	
}