<?php

namespace dw\classes;

use dw\accessors\session;

class dwSession {
	
	/**
	 * Constructor
	 * Initialize session
	 */
	public function __construct($autostart = false) {
		if($autostart) {
			session::start();
		}
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
	 * Commit session
	 */
	public function save() {
		session::commit();
	}

	/**
	 * Explicit get function
	 * @param string $name
	 * @param mixed $defaultValue
	 */
	public function get($name, $defaultValue = null) {
		return session::get($name, $defaultValue);
	}
	
	/**
	 * Explicit set function
	 * @param strin $name
	 * @param mixed $value
	 */
	public function set($name, $value) {
		if($value === null) {
			return session::remove($name);
		}
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
		return $this -> get($name);
	}
	
	public function __set($name, $value) {
		return $this -> set($name,$value);
	}
	
	public function __invoke() {
		$this -> __debugInfo(); 
	}
	
	public function __debugInfo() {
		print_r($_SESSION);
	}

}

?>