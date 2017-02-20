<?php

namespace dw;

use dw\helpers\dwFile;
use dw\accessors\ary;

/**
 * Manage connector list
 * @author QuentinSup
 * @package dw
 */
class dwConnectors {
	
	protected static $_connectors = array();
	
	/**
	 * Load a connector files from directory
	 * @param $dirpath the directory to found the connectors
	 */
	public static function loadConnectors($dirpath) {
		
		$connectorsList = dwFile::ls($dirpath);
		foreach($connectorsList as $connectorPath) {

			if(!is_dir($connectorPath)) {
			
				include_once($connectorPath);

				$connectorClassName = "dw\\connectors\\".dwFile::getAbsoluteName($connectorPath);
				$connectorName = $connectorClassName::getName();

				self::$_connectors[$connectorName] = $connectorClassName;
			}
			
		}

	}
	/**
	 * Return a new instance of a connector
	 * @param $name the connector name to build
	 * @return the instance|NULL
	 */
	public static function factory($name) {
		$connectorClassName = ary::get(self::$_connectors, $name, null);
		return $connectorClassName?new $connectorClassName():null;
	}
	
	
}

?>