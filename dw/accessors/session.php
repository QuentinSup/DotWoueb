<?php

namespace dw\accessors;

/**
 * session
 * Accessor to secure manage session
 * @author QuentinSup
 * @version 1.0
 * @package dotWoueb
 */

class session
{
	
	/**
	 * Prevent implementation
	 */
	private function __construct() {}
	
	/**
	 * Return true if a session has been started and is still active
	 * @return boolean
	 */
	public static function isActive() {
		return self::status() == PHP_SESSION_ACTIVE;
	}
	
	/**
	 * Return session current status
	 * @return unknown
	 */
	public static function status() {
		return session_status();
	}
	
	/**
	 * Secure start of a session
	 * If a session is already active, do not try to start again (avoid exception) 
	 */
	public static function start() {
		if(!session::isActive()) {
			session_start();
		}
	}
	
	/**
	 * Commit and close session
	 */
	public static function commit() {
		session_commit();
	}
	
	/**
	 * Return current session id.
	 * Could be empty if session has not been started yet
	 */
	public static function getSessionId()
	{
		if(!self::isActive()) {
			session::start();
		}
		return session_id();
	}	
	
	/**
	 * Affecte une valeur ࠵ne variable de session
	 * @param string $sname nom de la variable
	 * @param mixed $msvalue valeur
	 */
	public static function set($sname, $mvalue)
	{
		if(!self::isActive()) {
			session::start();
		}
		$_SESSION[$sname] = $mvalue;
	}	

	/**
	 * Set value session and auto close to allow concurrent access
	 * @param string $sname
	 * @param mixed $mvalue
	 */
	public static function set_concurrent($sname, $mvalue) {
		session::set($sname, $mvalue);
		session::commit();
	}
	
	/**
	 * Return a value from session.
	 * Autostart session if needed 
	 * @param string $sname the name of the session attribute
	 * @param mixed $defaultvalue a default value if the attribute is not set
	 */
	public static function get($sname, $defaultvalue = null)
	{
		if(!session::isActive()) {
			session::start();
		}
		
		if(isset($_SESSION[$sname]))
		{
			return $_SESSION[$sname];
		} else {
			return $defaultvalue;	
		}
	}

	/**
	 * Remove a value from session
	 * autostart session if needed
	 * @param string $sname attribute name
	 */
	public static function remove($sname)
	{
		if(!session::isActive()) {
			session::start();
		}
		
		unset($_SESSION[$sname]);
	}

	/**
	 * Remove all values from session
	 * autostart session if needed
	 * @param array $aexceptlist a set of exception
	 */
	public static function clear($aexceptlist = null)
	{
		if(!session::isActive()) {
			session::start();
		}
		
		if($aexceptlist === null) {
			session_unset();
			return;
		}
		
		foreach(array_keys($_SESSION) as $session)
		{
			if(!in_array($session, $aexceptlist))
			{
				self::remove($session);	
			}	
		}
	}

	/**
	 * Return true if the attribute is set into session
	 * autostart session if needed
	 * @param string $sname the attribute name
	 */
	public static function exists($sname)
	{
		if(!session::isActive()) {
			session::start();
		}

		return isset($_SESSION[$sname]);
	}

	/**
	 * Destroy current session
	 */
	public static function destroy()
	{
		session_destroy();
	}
	
	/**
	 * Regenerate session id
	 */
	public static function regenerateId() {
		session_regenerate_id(true);
	}
	
}

?>