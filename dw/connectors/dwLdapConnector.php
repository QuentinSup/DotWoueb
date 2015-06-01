<?php

namespace dw\connectors;

use dw\classes\dwConnectorInterface;
use dw\connectors\ldap\dwLdapConnection;

class dwLdapConnector implements dwConnectorInterface {
	
	public $server = '';
	public $dn = '';
	public $passwd = '';
	public $port = 389;
	
	protected $_connection = null;
	
	public static function getName() {
		return "ldap";
	}
		
	public function getInstance() {
		return $this -> _connection;
	}
	
	public function digestConfig($xml) {
		$this -> server	= @(string)$xml -> server;
		$this -> dn		= @(string)$xml -> dn;
		$this -> passwd	= @(string)$xml -> passwd;
		$this -> port	= @(string)$xml -> port;
	}
	
	public function prepare() {
		
		$this -> _connection = new dwLdapConnection($this -> _server, $this -> _port);
		$this -> _connection -> connect($this -> dn, $this -> passwd);
		
	}

}

?>