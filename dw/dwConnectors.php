<?php

namespace dw;

use dw\helpers\dwFile;
use dw\accessors\ary;

class dwConnectors {
	
	protected static $_connectors = array();
	
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
	
	public static function factory($name) {
		$connectorClassName = ary::get(self::$_connectors, $name, null);
		return $connectorClassName?new $connectorClassName():null;
	}
	
	
}

?>