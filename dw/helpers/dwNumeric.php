<?php

namespace dw\helpers;
 
class dwNumeric
{
	private static $_iprecision = 10;
	
	/**
	 * getPrecision()
	 * Retourne la valeur de $i_precision
	 * @return int
	 */
	public static function getPrecision()
	{
		return self::$_iprecision;
	}

	/**
	 * setPrecision()
	 * Change la valeur de $i_precision
	 * @param int $iprecision Nouvelle valeur
	 */
	public static function setPrecision($iprecision)
	{
		self::$_iprecision = $iprecision;
	}
	
	/**
	 * round();
	 * Arrondi une valeur avec une pr飩sion d馩nie par setPrecision() (alias de Round())
	 * @return float
	 * @param float $fvalue valeur num鲩que
	 */	
	function round($fvalue)
	{
		return round($fvalue, self::$_iprecision);
	}
	
}
 
?>