<?php

ini_set("magic_quotes_gpc", "0");
ini_set("short_open_tag", "1");

date_default_timezone_set('Europe/Paris');

define('DW_INIT_GZIP', '0');
define("WORK_PATH", dirname(__FILE__));
define("APP_DIR", realpath("../")."/");

/**
 * include once a php library
 * @param $className library name (without '.php')
 * The file must be relative from DW_BASE_DIR const value
 */
function dw_require($className)
{
	return include_once(DW_BASE_DIR.$className.'.php');
}

/**
 * Return true if the parameter is a sequentiel array
 * @param unknown $ary
 * @return boolean
 */
function is_seq($ary) {
	
	return is_array($ary) && is_numeric(implode(array_keys($ary)));
}

/**
 * Return true if the parameter is an associative array (key => value)
 * @param unknown $ary
 * @return boolean
 */
function is_assoc($ary) {
	
	return is_array($ary) && !is_seq($ary);
}

/**
 * Return true if the parameter is a strict associative array (no numeric as key)
 * @param unknown $ary
 * @return boolean
 */
function is_strict_assoc($ary) {
	return is_array($ary) && (count(array_filter(array_keys($ary), "is_numeric")) == 0);
}

?>