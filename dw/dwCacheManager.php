<?php

namespace dw;

use dw\classes\dwLogger;

/**
 * Cache manager
 */
class dwCacheManager {
	
	protected static $_scacheDir 	= './';
	protected static $_acache 		= array();
	protected static $_buseCache 	= false;
	
	// Logger
	private static function logger() {
		static $logger = null;
		if(is_null($logger)) {
			$logger = dwLogger::getLogger(__CLASS__);
		}
		return $logger;
	}
	
	/**
	 * Set cache files directory
	 * @param unknown $sdir
	 */
	public static function setCacheDir($sdir)
	{
		self::$_scacheDir = $sdir;
	}

	/**
	 * Return cache files directory
	 * @return unknown
	 */
	public static function getCacheDir()
	{
		return self::$_scacheDir;
	}
	
	/**
	 * Enable or Disable cache
	 * @param string $bool
	 */
	public static function setUseCache($bool = true)
	{
		self::$_buseCache = $bool;
	}

	/**
	 * Return if cache is enabled
	 * @return unknown
	 */
	public static function isCacheEnabled()
	{
		return self::$_buseCache;
	}

	/**
	 * Put an object into file cache
	 * @param unknown $scacheID
	 * @param unknown $object
	 * @return boolean
	 */
	public static function setCache($scacheID, $object, $keepInMemory = true)
	{
		
		if(self::logger() -> isTraceEnabled()) {
			self::logger() -> trace("Update cache for '$scacheID' (keepInMemory: $keepInMemory)");
		}
		
		$skeyCache 	= md5($scacheID);
		$scachefile = self::getCacheFileName($skeyCache);
		if(is_null($object)) {
			
			if(self::logger() -> isDebugEnabled()) {
				self::logger() -> debug("Cache value for '$scacheID' is NULL : cache will not be updated");
			}
			
			return false;	
		}
			
		
		if(self::logger() -> isDebugEnabled()) {
			self::logger() -> debug("Update cache for '$scacheID' into cache file '$scachefile'");
		}
			
		if(!file_put_contents($scachefile, serialize($object)) > 0)
		{
		
			if(self::logger() -> isWarnEnabled()) {
				self::logger() -> warn("Cache for '$scacheID' was not created");
			}
			
			return false;
		}

		
		if($keepInMemory) {
			
			if(self::logger() -> isTraceEnabled()) {
				self::logger() -> trace("Keep cache for '$scacheID' in memory");
			}
			
			self::$_acache[$skeyCache] = &$object;
		}
		
		return true;
	}
	
	/**
	 * Get a data from cache
	 * @param unknown $scacheID
	 * @param string $keepInMemory
	 * @param number $timeLimit
	 * @return unknown|NULL
	 */
	public static function getCache($scacheID, $timeLimit = 0, $keepInMemory = true)
	{
		
		if(self::logger() -> isTraceEnabled()) {
			self::logger() -> trace("Return cache for '$scacheID' (keepInMemory: $keepInMemory, timeLimit: $timeLimit)");
		}
		
		$skeyCache = md5($scacheID);
		$scachefile = self::getCacheFileName($skeyCache);
		
		if(isset(self::$_acache[$skeyCache])) {
			
			if(self::logger() -> isDebugEnabled()) {
				self::logger() -> debug("Return cache for '$scacheID' from memory");
			}
			
			return self::$_acache[$skeyCache];
		}
		
		$object  = FALSE;
		
		if(!file_exists($scachefile)) {

			if(self::logger() -> isDebugEnabled()) {
				self::logger() -> debug("No cache found for '$scacheID'");
			}
			
			return FALSE;
		}
		
		$now = time();
		$mtime = @filemtime($scachefile);
		
		if($mtime === FALSE) {
			
			if(self::logger() -> isErrorEnabled()) {
				self::logger() -> error("Error extracting filemtime '$scacheID' from file '$scachefile'");
			}
			
			return FALSE;
		}
		
		if($timeLimit > 0 && ($now - $mtime) > $timeLimit) {
			
			if(self::logger() -> isDebugEnabled()) {
				self::logger() -> debug("Cache time of '$scacheID' exceed time limit (filemtime: $mtime, timelimit: $timeLimit) : cache is deprecated (remove current cache)");
			}
			
			unlink($scachefile);
			
		} else {
		
			if(self::logger() -> isDebugEnabled()) {
				self::logger() -> debug("Return data cached of '$scacheID' from '$scachefile'");
			}
			
	 		$sObject = file_get_contents($scachefile);
	 		if(!empty($sObject))
	 		{
	 			$object = unserialize($sObject);
	 			if($keepInMemory) {
	 				
	 				if(self::logger() -> isDebugEnabled()) {
	 					self::logger() -> debug("Keep data cached into memory (for next calls)");
	 				}
	 				
	 				self::$_acache[$skeyCache] = &$object;
	 			}
	 		} else {
	 			if(self::logger() -> isWarnEnabled()) {
	 				self::logger() -> warn("Cache for '$scacheID' is empty");
	 			}
	 		}
	 		
		}
  		return $object;
	}

	/**
	 * Alias of setCache()
	 * Take account of isCacheEnabled() value
	 * @param unknown $scacheID
	 * @param unknown $object
	 * @return boolean
	 */
	public static function set($scacheID, $object)
	{
		if(!self::$_buseCache) {
			
			if(self::logger() -> isWarnEnabled()) {
				self::logger() -> warn("Attemp to put '$scacheID' into cache : cache if disabled");
			}
			
			return true;
		}
		self::setCache($scacheID, $object);
		return true;
	}
	
	/**
	 * Alias of getCache()
	 * Take account of isCacheEnabled() value
	 * @param unknown $scacheID
	 * @return cache value
	 */
	public static function get($scacheID)
	{
		$scachefile = self::getCacheFileName(md5($scacheID));
		if(self::$_buseCache) {			
			return self::getCache($scacheID);
 		} else {
 			
 			if(self::logger() -> isWarnEnabled()) {
 				self::logger() -> warn("Attemp to get '$scacheID' from cache : cache if disabled");
 			}
 			
 			if(file_exists($scachefile)) {
 				
 				if(self::logger() -> isDebugEnabled()) {
 					self::logger() -> debug("Delete cache file '$scachefile' for '$scacheID'");
 				}
 				
				unlink($scachefile);
 			}
		}
  		return null;
	}
	
	/**
	 * Returne cache file name into cache
	 * @param unknown $skeyCache
	 * @return string
	 */
	public static function getCacheFileName($skeyCache)
	{
		return self::$_scacheDir.$skeyCache.".cache";
	}
	
}