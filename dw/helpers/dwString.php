<?php

namespace dw\helpers;

class dwString
{
	
	/**
	 * toDateTime()
	 * Converti une chaine au format dd/mm/yyyy hh:nn au format yyyy-mm-dd hh:nn
	 * @return string
	 * @param string $sdate valeur de la date au format dd/mm/yyyy 
	 */
	public static function toDateTime($sdate)
	{
		return eregi_replace("([0-9].*)\/([0-9].*)\/([0-9]{2,4})(.*){0,1}", "\\3-\\2-\\1\\4", $sdate);
	}

	/**
	 * toDate()
	 * Converti une chaine au format dd/mm/yyyy [hh:nn] au format yyyy-mm-dd
	 * @return string
	 * @param string $sdate valeur de la date au format dd/mm/yyyy 
	 */
	public static function toDate($sdate)
	{
		return eregi_replace("([0-9].*)\/([0-9].*)\/([0-9]{2,4})(.*){0,1}", "\\3-\\2-\\1", $sdate);
	}

	/**
	 * generate()
	 * G鮩re une chaine de longueur $ilength ࠰artir de $scaracters
	 * @return string
	 * @param int $ilength longueur de la chaine ࠧ鮩rer
	 * @param string $scaracters chaine contenant les caract貥s ࠵tiliser 
	 */
	public static function generate($ilength = 10, $scaracters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789")
	{
   		srand((double)microtime()*1000000);
		$stemp      = '';
		$imaxlength = strlen($scaracters);
   		for($i=0; $i<$ilength; $i++)
   		{
   			$stemp .= $scaracters[rand()%$imaxlength];
   		}
		return $stemp;
	}

	/**
	 * toTime()
	 * Converti une chaine au format dd/mm/yyyy hh:nn en sa valeur timestamp
	 * @return int
	 * @param string $sdate date au format dd/mm/yyyy hh:nn
	 * @param string $sseparator s鰡rateur(s) 
	 */
	public static function toTime($sdate, $sseparator = "[/ :]")
	{
		$sdate=split($sseparator,$sdate);
		return mktime($sdate[3], $sdate[4], $sdate[5], $sdate[1], $sdate[0], $sdate[2]);
	}

	/**
	 * checkFormat()
	 * Vérifie le format de la chaine
	 * @return bool
	 * @param string $sstring Chaine de caractère
	 * @param string $sformat Format utilisé our la vérfication
	 */
	public static function checkFormat($sstring, $sformat) {
    	return ereg($sformat, $sstring);
	}
	
	/**
	 * Return true if the string starts with the specified occurence of $needle
	 * @return bool
	 * @param string $str The string
	 * @param string $needle The occurence to find
	 */
	public static function startsWith($str, $needle) {
		return strpos($str, $needle) === 0;
	}
	
	/**
	 * Return true if the string ends with the specified occurence of $needle
	 * @return bool
	 * @param string $str The string
	 * @param string $needle The occurence to find
	 */
	public static function endsWith($str, $needle) {
		return stripos($str, $needle) === strlen($str) - strlen($needle);
	}
	
	/**
	 * Convert a string to a contextual link
	 * @param str
	 * return formatted string
	 */
	public static function f2link($str) {
		$link = preg_replace("/[^a-zA-Z 0-9\-]+/", "", strtolower($str));
		$link = htmlentities(str_replace(" ", "-", $link));
		return $link;
	}
	
}
?>
