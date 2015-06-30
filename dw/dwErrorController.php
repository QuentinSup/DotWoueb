<?php

namespace dw;

use dw\classes\dwError;
use dw\classes\dwLogger;
use dw\classes\dwException;
use dw\dwFramework as dw;

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

		
		$ae = new dwError($ierrno, $serrstr, $serrfile, $ierrline);
		
		self::logger() -> error("Error $ierrno on file $serrfile at line $ierrline : $serrstr");
		
		self::addError($ae);

		#si le caractere "@" de suppression d'affichage d'erreur est detecte, retourne null
        if (error_reporting() == 0) {
            return null;
		}
		
		if(dw::isDebug())
       	{
			echo "<br />******<br />";
        	dwError::raise($ae);
			debug_print_backtrace();
			echo "<br />******<br />";

        }
		
	}
	
	/**
	 * Appelle quand une exception n'est pas capturee. Affiche un message a l'utilisateur suivant le mode actif de l'application (DEBUG ou RELEASE) et inscrit l'erreur dans le loggeur par defaut.
	 * @param exception l'exception
	 */
	public static function exceptionHandler($exception)
	{
		self::logger() -> fatal(dwException::toArray($exception));
		
		if(dw::isDebug())
       	{
			echo "<br />******<br />";
        	dwException::raise($exception);
			debug_print_backtrace();
			echo "<br />******<br />";

		}
	}
	
	/**
	 * Initialise la capture des exceptions et des erreurs
	 */
	public static function setHandler()
	{
        set_error_handler(array('dw\dwErrorController', 'errorHandler'));
		set_exception_handler(array('dw\dwErrorController', 'exceptionHandler'));
	}
	
	
}
?>