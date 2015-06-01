<?php

namespace dw\classes;

use dw\classes\dwCache;

class dwCacheFile extends dwCache
{
	protected static $_scacheDir 	= './';
	protected static $_acache 		= array();
	protected static $_buseCache 	= false;
	
	/***************************************************************************
	 * D馩ni le chemin ou sont stock鳠les fichiers de cache
	 * @param $sdir dossier
	 ***************************************************************************/
	public static function setCacheDir($sdir)
	{
		self::$_scacheDir = $sdir;
	}

	/***************************************************************************
	 * Retourne le chemin ou sont stock鳠les fichiers de cache
	 * @return string
	 ***************************************************************************/
	public static function getCacheDir()
	{
		return self::$_scacheDir;
	}
	
	/***************************************************************************
	 * D馩ni le chemin ou sont stock鳠les fichiers de cache
	 * @param $sdir dossier
	 ***************************************************************************/
	public static function setUseCache($bool = true)
	{
		self::$_buseCache = $bool;
	}

	/***************************************************************************
	 * Retourne le chemin ou sont stock鳠les fichiers de cache
	 * @return string
	 ***************************************************************************/
	public static function getUseCache()
	{
		return self::$_buseCache;
	}

	public function setCache($scacheID, $object)
	{
		$skeyCache 	= md5($scacheID);
		$scachefile = self::getCacheFileName($skeyCache);
		if(!is_null($object))
		{
			if(file_put_contents($scachefile, serialize($object)) > 0)
			{
				return true;
			}
		}
		self::$_acache[$skeyCache] = &$object;
		return true;
	}
	
	public function getCache($scacheID)
	{
		$skeyCache = md5($scacheID);
		$scachefile = self::getCacheFileName($skeyCache);
		if(isset(self::$_acache[$skeyCache]))
		{
			return self::$_acache[$skeyCache];
		}
		$object  = null;
 		$sObject = file_get_contents($scachefile);
 		if(!empty($sObject))
 		{
 			$object = unserialize($sObject);
 			self::$_acache[$skeyCache] = &$object;
 		}
  		return $object;
	}

	public function set($scacheID, $object)
	{
		if(!self::$_buseCache)
		{
			return true;
		}
		self::setCache($scacheID, $object);
		return true;
	}
	
	public function get($scacheID)
	{
		$scachefile = self::getCacheFileName(md5($scacheID));
		if(self::$_buseCache)
		{
			return self::getCache($scacheID);
 		} elseif(file_exists($scachefile)) {
			unlink($scachefile);
		}
  		return null;
	}
	
	public static function getCacheFileName($skeyCache)
	{
		return self::$_scacheDir.$skeyCache.".cache";
	}
	
}

?>