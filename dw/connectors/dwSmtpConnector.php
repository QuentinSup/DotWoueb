<?php

namespace dw\connectors;

use dw\classes\dwConnectorInterface;

dw_require('vendors/PHPMailer/class.phpmailer');

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

		$mail = new \PHPMailer();
		
		$mail->Host = $this -> _smtp;  							// Specify main and backup SMTP servers
		$mail->Port = $this -> _port;                              // TCP port to connect to
		$mail->CharSet = "utf-8";
		$mail->Encoding = "base64";
		
		$mail->setFrom($this -> _from);
		$mail->addAddress($this -> fMailField($to));     // Add a recipient
		
		//$mail->addReplyTo('info@example.com', 'Information');
		$mail->addCC($this -> fMailField($cc));
		$mail->addBCC($this -> fMailField($bcc));
		
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = $subject;
		$mail->Body    = $text;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		

		/*
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0"."\n";
		$headers .= "Content-Type: text/html; charset=\"UTF-8\""."\n";
		$headers .= 'From: '.$this -> _from."\n";
		if(isset($cc)) {
			$headers .= 'Cc: '.$this -> fMailField($cc)."\n";	
		}
		if(isset($bcc)) {
			$headers .= 'Bcc: '.$this -> fMailField($bcc)."\n";
		}
		*/
		
		//return mail($this -> fMailField($to), "=?UTF-8?B?".base64_encode($subject)."?=", $text, $headers);
		//return mail(null, "=?UTF-8?B?".base64_encode($subject)."?=", null, $headers);
		
		return $mail -> send();
		
	}
	
}

?>