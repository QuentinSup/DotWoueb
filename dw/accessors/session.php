<?php

namespace dw\accessors;

use dw\accessors\ary;

/**
 * session
 * G貥 les variables de session
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

class session
{
	
	/**
	 * retourne l'id de la session
	 */
	public static function getSessionId()
	{
		return session_id();
	}	
	
	/**
	 * Affecte une valeur ࠵ne variable de session
	 * @param string $sname nom de la variable
	 * @param mixed $msvalue valeur
	 */
	public static function set($sname, $mvalue)
	{
		$_SESSION[$sname] = $mvalue;
	}	

	/**
	 * Recup貥 la valeur d'une variable de session. 
	 * Si la variable n'existe pas, renvoie une valeur par d馡ut
	 * @param string $sname nom de la variable
	 * @param mixed $defaultvalue valeur par defaut
	 */
	public static function get($sname, $defaultvalue = null)
	{
		if(isset($_SESSION[$sname]))
		{
			return $_SESSION[$sname];
		} else {
			return $defaultvalue;	
		}
	}

	/**
	 * Supprimer une variable de session 
	 * @param string $sname nom de la variable
	 */
	public static function kill($sname)
	{
		unset($_SESSION[$sname]);
	}

	/**
	 * Supprimer toutes les variables de session 
	 * @param array $aexceptlist une liste d'exceptions
	 */
	public static function killAll($aexceptlist = array())
	{
		foreach(array_keys($_SESSION) as $session)
		{
			if(!in_array($session, $aexceptlist))
			{
				self::kill($session);	
			}	
		}
	}

	/**
	 * Renvoi si la variable de session existe  
	 * @param string $sname nom de la variable
	 */
	public static function exist($sname)
	{
		return isset($_SESSION[$sname]);
	}

	public static function destroy()
	{
		session_destroy();
	}

}

?>