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
				self::registerConnector($connectorClassName);
			}
			
		}

	}
	
	/**
	 * Load a connector file
	 * @param $file the connector file
	 */
	public static function loadConnector($file) {
		include_once($file);
		$connectorClassName = "dw\\connectors\\".dwFile::getAbsoluteName($file);
		self::registerConnector($connectorClassName);
	}
	
	/**
	 * Register a connector class
	 * @param unknown $connectorClassName
	 */
	public static function registerConnector($connectorClassName) {
		if(!is_subclass_of($connectorClassName, 'dw\classes\dwConnectorInterface')) {
			throw new Exception("The connector $connectorClassName must inherits 'dwConnectorInterface' interface.");	
		}
		self::$_connectors[$connectorClassName::getName()] = $connectorClassName;
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