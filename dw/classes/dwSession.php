<?php

namespace dw\classes;

use dw\accessors\session;

class dwSession {
	
	/**
	 * Constructor
	 * Initialize session
	 */
	public function __construct() {
		session::start();
	}
	
	/**
	 * Return session id
	 * @return string
	 */
	public function getId() {
		return session::getSessionId();
	}
	
	/**
	 * Clear all data
	 */
	public function clear() {
		session::clear();
	}

	/**
	 * Destroy session
	 * @see session_destroy()
	 * @see session::destroy()
	 */
	public function destroy() {
		session::destroy();
	}
	
	/**
	 * Clean data and start a new session with a new id
	 */
	public function start() {
		$this -> clear();
		session::regenerateId();
	}

	/**
	 * Explicit get function
	 * @param string $name
	 * @param mixed $defaultValue
	 */
	public function get($name, $defaultValue) {
		return session::get($name, $defaultValue);
	}
	
	/**
	 * Explicit set function
	 * @param strin $name
	 * @param mixed $value
	 */
	public function set($name, $value) {
		session::set($name, $value);
	}
	
	/**
	 * Check if data is set
	 * @param unknown $name
	 * @return unknown
	 */
	public function has($name) {
		return session::exists($name);
	}
	
	
	public function __get($name) {
		return session::get($name);
	}
	
	public function __set($name, $value) {
		if($value === null) {
			return session::remove($name);
		}
		return session::set($name,$value);
	}

}

?>