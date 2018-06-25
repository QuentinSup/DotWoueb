<?php

namespace dw\classes;

class dwSocket
{
	
	private $_hostname;
	private $_remotename;
	
	private $_blockingMode;
	
	private $_socket = false;
	
	// Logger
	private static function logger() {
		static $logger = null;
		if(is_null($logger)) {
			$logger = dwLogger::getLogger(__CLASS__);
		}
		return $logger;
	}
	
	/**
	 * Constructeur
	 */
	public function __construct($blocking = 1) {
		$this -> _blockingMode = $blocking;
	}
	
	/**
	 * Connect to remote $adress, using $port if specified
	 */
	public function pconnect($adress, $port = 0, $timeout = null) {
		return $this -> connect($adress, $port, $timeout, true);
	}
	
	/**
	 * Connect to remote $adress, using $port if specified
	 */
	public function connect($adress, $port = 0, $timeout = null, $persistent = false) {
		
		$this -> close();
		
		$errno = null;
		$errstr = null;
	
		if($persistent) {
			$socket = pfsockopen($adress, $port, $errno, $errstr, $timeout);
		} else {
			$socket = fsockopen($adress, $port, $errno, $errstr, $timeout);
		}

		if($socket === false) {
			self::logger() -> warn($errstr);
		} else {
			stream_set_blocking($socket, $this -> _blockingMode);
		}

		$this -> _socket = $socket;
		
		return $socket;
	}
	
	public function close() {
		if($this -> _socket !== false) {
			fclose($this -> _socket);
			$this -> _socket = false;
			$this -> _hostname = null;
			$this -> _remotename = null;
		}
	}
	
	public function getSocket() {
		return $this -> _socket;
	}
	
	public function getHostName() {
		return $this -> _hostname;
	}
	
	public function getRemoteName() {
		return $this -> _remotename;
	}
	
	public function setTimeout($seconds) {
		\stream_set_timeout($this -> _socket, $seconds);
	}
	
	public function sendLn($text = '') {
		return $this -> send("$text\r\n");
	}
	
	public function send($text) {
		
		for ($written = 0; $written < strlen($text); $written += $fwrite) {
			$fwrite = fwrite($this -> _socket, substr($text, $written));
			if ($fwrite === false) {
				return FALSE;
			}
		}
		return $written;
	}
	
	public function read() {
		return fgets($this -> _socket);
	}
	
	public function isEOF() {
		return feof($this -> _socket);
	}
	
	public function readAll() {
		$content = "";
		while(!$this -> isEOF()) {
			$content .= $this -> read();
		}
		return $content;
	}
	
	
	public function waitForData($timeout = 30) {
		$content = "";
		$delay = 100;
		$endLoop = $timeout * 1000 / $delay;
		$nbLoop = 0;
		while($content == "" && $nbLoop <= $endLoop) {
			$nbLoop++;
			$content = $this -> read();
			if($content == "") {
				usleep($delay);	
			}
		}
		return $content;
	}
	
	public function resolveHostName() {
		return \socket_getsockname($socket, $this -> _hostname);
	}
	
	public function resolveRemoteName() {
		return \socket_getpeername($socket, $this -> _remotename);
	}
	
	public function getMetaData($meta = null) {
		$metas = \stream_get_meta_data($this -> _socket);
		if(is_null($meta)) {
			return $metas;
		}
		return $metas[$meta];
	}

	public function isTimedOut() {
		return $this -> getMetaData('timed_out');	
	}	
		
}