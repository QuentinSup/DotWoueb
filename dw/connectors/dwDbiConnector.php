<?php

namespace dw\connectors;

use dw\classes\dwConnectorInterface;
use dw\connectors\dbi\dbi;

class dwDbiConnector implements dwConnectorInterface {
	
	protected $_dsn = null;
	protected $_autoconnect = null;
	protected $_db = null;
	
	public static function getName() {
		return "dbi";
	}
	
	public function digestConfig($xmlConfiguration) {
		$this -> _dsn			= (string)$xmlConfiguration -> dsn;
		$this -> _autoconnect	= (int)$xmlConfiguration -> autoconnect == 1?true:false;
	}
	
	public function prepare() {
		/* Si le paramètre de connexion automatique (autoconnect) est défini
		 * Se connecte à la base de données
		 */
		$this -> _db = new dbi();
		if($this -> getAutoConnect())
		{
			$this -> _db -> connect($this -> getDSN());
		}
	}
	
	public function getAutoConnect() {
		return $this -> _autoconnect;
	}
	
	public function getDSN() {
		return $this -> _dsn;
	}
	
	public function getInstance() {
		return $this -> _db;
	}

}