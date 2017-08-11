<?php

namespace dw\classes;

use dw\dwCacheManager;

class dwCache implements dwCacheInterface {
	
	private $cacheRef;
	private $timeLimit;
	
	/**
	 * Constructor
	 * @param unknown $cacheRef cache reference
	 * @param unknown $timeLimit time limit in cache
	 */
	public function __construct($cacheRef, $timeLimit) {
		$this -> cacheRef 	= $cacheRef;
		$this -> timeLimit 	= $timeLimit;
	}
	
	/**
	 * Return cache reference (passed into constructor)
	 * @return unknown
	 */
	public function getRef() {
		return $this -> cacheRef;
	}
	
	/**
	 * 
	 * @param unknown $object
	 */
	public function put($data) {
		return dwCacheManager::setCache($this -> cacheRef, $data);
	}
	
	/**
	 * Return content from cache
	 */
	public function get() {
		return dwCacheManager::getCache($this -> cacheRef, $this -> timeLimit);
	}
	
}

?>