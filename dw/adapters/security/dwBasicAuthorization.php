<?php 

namespace dw\adapters\security;

use dw\classes\dwSecurityAdapterInterface;
use dw\classes\dwHttpRequest;
use dw\classes\dwHttpResponse;
use dw\helpers\dwArray;

class dwBasicAuthorization implements dwSecurityAdapterInterface {
	
	private $_users;
	
	public function __construct() {
		$this -> _users = new dwArray();
	}
	
	protected function addUserConfig($userConfig) {
		$name = (string)$userConfig -> name;
		$passwd = (string)$userConfig -> cdata;
		$this -> _users -> set($name, $passwd);
	}
	
	public function isValidUser($name, $passwd) {
		return $this -> _users -> get($name) == $passwd;
	}
	
	public function digestConfig($config) {
		if($config -> users && $config -> users -> user) {
			foreach($config -> users -> user as $userConfig) {
				$this -> addUserConfig($userConfig);
			}
		}
	}
	
	public function prepare() {
		
	}

	public function control(dwHttpRequest $request, dwHttpResponse $response) {
	
		$authent = $request -> Header('Authorization');
		
		if($authent && strpos(strtolower($authent), 'basic') !== FALSE) {
				
			list($username, $password) = explode(':' , base64_decode(substr($authent, 6)));
					
			if($this -> isValidUser($username, $password)) {
				return;
			}
		}
		
		$response -> Header('WWW-Authenticate', 'Basic realm="'.$request -> getBaseUri().'"');
		return false;
		
	}
	
}