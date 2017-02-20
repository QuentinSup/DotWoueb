<?php

namespace dw\connectors;

use dw\classes\dwConnectorInterface;

/**
 * Smtp connector
 * @author QuentinSup
 *
 */
class dwSmtpConnector implements dwConnectorInterface {

	protected $_from = null;
	protected $_smtp = null;
	protected $_port = null;
	
	public static function getName() {
		return "smtp";
	}
	
	public function digestConfig($xml) {
		$this -> _from = @(string)$xml -> from;
		$this -> _smtp = @(string)$xml -> smtp;
		$this -> _port = @(string)$xml -> port;
	}
	
	public function prepare() {
		// NA
		if(!$this -> _smtp) {
			$this -> _smtp = ini_get("SMTP");
		}
		if(!$this -> _port) {
			$this -> _port = ini_get("smtp_port");
		}
		if(!$this -> _from) {
			$this -> _from = ini_get("smtp_from");
		}
	}
	
	public function getInstance() {
		return $this;
	}
	
	public function setFrom($from) {
		$this -> _from  = $from;
	}
	
	public function getFrom() {
		return $this -> _from;
	}
	
	public function setSMTP($smtp) {
		$this -> _smtp = $smtp;
	}
	
	public function getSMTP() {
		return $this -> _smtp;
	}
	
	public function setPort($port) {
		$this -> _port = $port;
	}
	
	public function getPort() {
		return $this -> _port;
	}
	
	public function fMailField($field) {
		if(!$field) { return null; }
		if(is_array($field)) {
			return implode(",", $field);
		}
		return $field;
	}
	
	/**
	 * Send an email
	 */
	public function send($to, $cc, $bcc, $subject, $text) {
		
		ini_set("SMTP", $this -> _smtp);
		ini_set("smtp_port", $this -> _port);

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0"."\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
		$headers .= 'From: '.$this -> _from."\r\n";
		if(isset($cc)) {
			$headers .= 'Cc: '.$this -> fMailField($cc)."\r\n";	
		}
		if(isset($bcc)) {
			$headers .= 'Bcc: '.$this -> fMailField($bcc)."\r\n";
		}

		return mail($this -> fMailField($to), $subject, $text, $headers);
	}
	
}

?>