<?php

use dw\dwCacheManager;

/**
 * Annotation Cache
 * @author QuentinSup
 */
class Cache extends Annotation {
	
	private $timelimit = null;
	
	/**
	 * @return the value set
	 */
	public function getValue() {
		return $this -> value;
	}
	
	/**
	 * Return the time limit set
	 * @return unknown
	 */
	public function getTimeLimit() {
		return $this -> timelimit;
	}
	
	/**
	 * 
	 * @param unknown $class
	 */
	public static function processProperty($app, $reflection, $reflectionProperty, $annotationClass, $annotationProperty) {
	
		if($annotationProperty) {

			$className = $reflection -> name;
			$propName = $reflectionProperty -> name;

			$cacheId = $annotationProperty -> getValue() || "$className::$propName";
			$timelimit= $annotationProperty -> getTimeLimit();
			
			$object = dwCacheManager::getCache($cacheId, $timelimit);
			if($object === FALSE) {
				return;
			}
			
			eval("$className::\$$propName = \$object;");

		}
	}
	
	/**
	 *
	 * @param unknown $class
	 */
	public static function endProperty($app, $reflection, $reflectionProperty, $annotationClass, $annotationProperty) {
		
		if($annotationProperty) {
			
			$className = $reflection -> name;
			$propName = $reflectionProperty -> name;
			
			$cacheId = "$className::$propName";
		
			
			eval("\$object = $className::\$$propName;");
			
			dwCacheManager::setCache($cacheId, $object);
			
		}
	}
	
	
}