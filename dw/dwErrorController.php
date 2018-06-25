<?php

namespace dw;

use dw\classes\dwError;
use dw\classes\dwLogger;
use dw\dwFramework as dw;
use dw\accessors\ary;

/**
 * Intercepte les erreurs et les exceptions non capturees
 * @author Quentin Supernant
 * @version 1.2
 * @package dotWoueb
  */
class dwErrorController
{
	#tableau des erreurs
	private static $_aerrors = array();
	
	// Logger
	private static function logger() {
		static $logger = null;
		if(is_null($logger)) {
			$logger = dwLogger::getLogger(__CLASS__);
		}
		return $logger;
	}
	
	/**
	 * Ajoute une erreur au tableau
	 * @param ressource $oerror objet Erreur
	 */
	public static function addError($oerror)
	{
		self::$_aerrors[] = $oerror;
	}
	
	/**
	 * Renvoi le tableau d'erreur
	 * Utiliser toArray() pour r飵p鲥r uniquement les erreurs d'un ou plusieurs types
	 */
	public static function getErrors()
	{
		return self::$_aerrors;
	}
	
	/**
	 * Renvoi les erreurs dans un tableau de valeurs preformatt銉 * @param array $aerrno filtre sur les num鲯s d'erreurs
	 * [count]
	 * [errors][][NO]
	 * [errors][][MESSAGE]
	 * [errors][][FILE]
	 * [errors][][LINE]
	 */
	public static function toArray($aerrno = null)
	{
		$ary = array();
		$icount = 0;

		foreach(self::$_aerrors as $oerror)
		{
			if(is_null($aerrno) || in_array($oerror -> getErrNo(), $aerrno))
			{
				$ary["list"][] = $oerror -> toArray();
				$icount++;
			}
		}
		$ary["count"] = $icount;
		return $ary;
	}
	
	public static function toArrayErrors()
	{
		return self::toArray(array(512));
	}
	
	public static function toArrayNotices()
	{
		return self::toArray(array(1024));
	}
	
	/**
	 * G鮩re une erreur
	 * @param string $smsg le message d erreur personnalise
	 * @param ressource $exception exception capturee
	 */
	public static function throwError($smsg, $exception = null)
	{
		trigger_error($smsg, 512);
		//if(!is_null($exception)) dwException::log($exception);
	}
	
	/**
	 * G鮩re une erreur de type NOTICE
	 * @param string $smsg le message d erreur personnalise
	 */
	public static function throwNotice($smsg)
	{
		trigger_error($smsg, 1024);	
	}
	
	
	public static function getErrorLib($level)
	{
		switch($level)
		{
			case E_ERROR: // 1 //
				return 'E_ERROR';
			case E_WARNING: // 2 //
				return 'E_WARNING';
			case E_PARSE: // 4 //
				return 'E_PARSE';
			case E_NOTICE: // 8 //
				return 'E_NOTICE';
			case E_CORE_ERROR: // 16 //
				return 'E_CORE_ERROR';
			case E_CORE_WARNING: // 32 //
				return 'E_CORE_WARNING';
			case E_COMPILE_ERROR: // 64 //
				return 'E_COMPILE_ERROR';
			case E_COMPILE_WARNING: // 128 //
				return 'E_COMPILE_WARNING';
			case E_USER_ERROR: // 256 //
				return 'E_USER_ERROR';
			case E_USER_WARNING: // 512 //
				return 'E_USER_WARNING';
			case E_USER_NOTICE: // 1024 //
				return 'E_USER_NOTICE';
			case E_STRICT: // 2048 //
				return 'E_STRICT';
			case E_RECOVERABLE_ERROR: // 4096 //
				return 'E_RECOVERABLE_ERROR';
			case E_DEPRECATED: // 8192 //
				return 'E_DEPRECATED';
			case E_USER_DEPRECATED: // 16384 //
				return 'E_USER_DEPRECATED';
		}
		return "ERROR";
	}
	
	/**
	 * Appele automatiquement lorsqu'une erreur se produit. Affiche un message a l'utilisateur suivant le mode actif de l'application (DEBUG ou RELEASE) et inscrit l'erreur dans le loggeur par defaut.
	 * @param int $ierrno numero de l'erreur
	 * @param string $serrstr descriptif de l'erreur
	 * @param string $serrfile fichier concerner par l'erreur
	 * @param int $ierrline ligne de l'erreur
	 * @return null* si le caractere "@" precede la ligne generant cette erreur ou si les rapport d'erreurs sont temporairement annules
	 */
	public static function errorHandler($ierrno, $serrstr, $serrfile, $ierrline)
	{

		#si le caractere "@" de suppression d'affichage d'erreur est detecte, retourne null
        if (error_reporting() == 0) {
        	self::logger() -> debug("Error $ierrno '$serrstr' on file $serrfile at line $ierrline");
            return null;
		}

		$lib = self::getErrorLib($ierrno);
		
		self::logger() -> error("$lib($ierrno) '$serrstr' on file $serrfile at line $ierrline");
		self::logger() -> error(self::getDebugBacktrace());
		
		if(dw::isDebug())
       	{
       		$ae = new dwError($ierrno, $serrstr, $serrfile, $ierrline);
       		self::addError($ae);
        }
		
	}
	
	public static function getDebugBacktrace() { 
		$trace = "";
       	$backTraces = debug_backtrace();
       	foreach($backTraces as $backTrace) {
       		if(isset($backTrace['file'])) {
    			$trace .= "# ".$backTrace['file'].", ".$backTrace['line']. " : ";
       		}
    		$trace .= ary::get($backTrace, 'class', '').ary::get($backTrace, 'type', '').@$backTrace['function']."\n";
       	}
        return $trace; 
    } 
	
	/**
	 * Appelle quand une exception n'est pas capturee. Affiche un message a l'utilisateur suivant le mode actif de l'application (DEBUG ou RELEASE) et inscrit l'erreur dans le loggeur par defaut.
	 * @param exception l'exception
	 */
	public static function exceptionHandler($exception)
	{
		self::logger() -> error("Exception '".$exception -> getMessage()."' from file ".$exception -> getFile()." at line ".$exception -> getLine());
		self::logger() -> error("\n".$exception -> getTraceAsString());
	}
	
	/**
	 * Appel lors d'une erreur fatale 
	 * @param exception l'exception
	 */
	public static function fatalHandler()
	{
		$error = error_get_last();
		if($error) {
			self::logger() -> fatal("Fatal error '".$error['message']."' from file ".$error['file']." at line ".$error['line']);
			self::logger() -> fatal(self::getDebugBacktrace());
			http_response_code(500);
		}

	}
	
	/**
	 * Initialise la capture des exceptions et des erreurs
	 */
	public static function setHandlers()
	{
		ini_set('display_errors', false); #in order to hide errors shown to user by php
		ini_set('log_errors', false); #assuming we log the errors our selves 
		ini_set('error_reporting', E_ALL); #We like to report all errors
		
        set_error_handler(array('dw\dwErrorController', 'errorHandler'));
		set_exception_handler(array('dw\dwErrorController', 'exceptionHandler'));
		register_shutdown_function(array('dw\dwErrorController', 'fatalHandler'));
	}
	
	
}