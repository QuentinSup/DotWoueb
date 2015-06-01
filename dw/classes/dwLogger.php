<?php

namespace dw\classes;

dw_require('vendors/log4php/Logger');

/**
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */
class dwLogger
{
	
	/**
	 * Return a logger
	 * @param $name The logger name
	 */
	public static function getLogger($className) {
		return \Logger::getLogger($className);
	}
	
	/**
	 * Configure the logger
	 * @param $filePath The path to the configuration file
	 */
	public static function configure($filePath) {
		// Tell log4php to use the configuration file.
		\Logger::configure($filePath);
	}
	
}

?>