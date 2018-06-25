<?php

namespace dw\helpers;

class dwDate 
{

	/**
	 * isDate()
	 * V鲩fie le format de la date
	 * @return bool
	 * @param string $sdate Date au format dd/mm/yyyy
	 * @param string $sformat Format utilis頰our la v鲩fication
	 */
	function isDate($sdate, $sformat = "((0[1-9])|(([1-2]{1})([0-9]{1}))|(3[0-1]))/((0[1-9])|(1[0-2]))/([1-9]{1})([0-9]{3})") {
	    return dwString::checkFormat($sdate, $sformat);
	}

	/**
	 * isHour()
	 * V鲩fie le format de l'heure
	 * @return bool
	 * @param string $shour Heure au format hh:nn
	 * @param string $sformat Format utilis頰our la v鲩fication
	 */
	function isHour($shour, $sformat = "(([0-1][0-9])|(2[0-4])):([0-5][0-9])") {
    	return dwString::checkFormat($shour, $sformat);
	}
		
	/**
	 * formatDateTime()
	 * Convertit une date au format yyyy-mm-dd [hh:nn] au format dd/mm/yyyy [hh:nn]
	 * @return string
	 * @param string  $sdt Valeur de la date au format yyyy-mm-dd hh:nn
	 * @param bool $bTime Inclu ou non l'information de l'heure dans la conversion
	 */
	public static function formatDateTime($sdt)
	{
		return eregi_replace("([0-9]{4})-([0-9]{2})-([0-9]{2})(.{9}){0,1}(.*){0,1}", "\\3/\\2/\\1\\4", $sdt);
	}

	/**
	 * formatDate()
	 * Convertit une date au format yyyy-mm-dd [hh:nn] au format dd/mm/yyyy
	 * @return string
	 * @param string  $sdt Valeur de la date au format yyyy-mm-dd [hh:nn]
	 */
	public static function formatDate($sdt)
	{
		return eregi_replace("([0-9]{4})-([0-9]{2})-([0-9]{2})(.{9}){0,1}(.*){0,1}", "\\3/\\2/\\1", $sdt);
	}

	/**
	 * toString()
	 * Renvoi la valeur de la date dans un format sp飩fique (alias de date())
	 * @return string
	 * @param string $sformat Format de la date ࠲etourner
	 * @param int $idate valeur de la date
	 */
	public static function toString($sformat = 'd/m/Y h:i', $idate = null)
	{
		if(is_null($idate))
		{
			$idate = time();
		}
		return date($sformat, $idate);
	}

	/**
	 * getMonth()
	 * Retourne la valeur du mois de la date
	 * @return int / string
	 * @param int $idate valeur de la date au format num鲩que
	 * @param array $aConvert tableau contenant la liste des Mois de l'ann饠
	 */
	function getMonth($idate, $aConvert = null)
	{
		if(!is_null($aConvert))
		{
			return $aConvert[date('m', $idate)];
		} else {
			return date('m', $idate);
		}
	}

	/**
	 * getDay();
	 * Retourne le jour de la date
	 * @return int
	 * @param int $idate valeur de la date au format num鲩que
	 */
	function getDay($idate)
	{
		return date('d', $idate);
	}

	/**
	 * getWeekDay()
	 * Retourne le jour de la semaine (0 = Dimanche)
	 * @return int / string
	 * @param int $idate valeur de la date au format num鲩que
	 * @param array $aConvert tableau contenant la liste des Jours de la semaine 
	 */
	function getWeekDay($idate, $aconvert = null)
	{
		if(!is_null($aconvert))
		{
			return $aconvert[date('w', $idate)];
		} else {
			return date('w', $idate);;
		}
	}

	/**
	 * getLiteralWeekDay()
	 * Retourne le jour de la semaine
	 * @return string
	 * @param int $idate valeur de la date au format num鲩que
	 * @param array $aConvert tableau contenant la liste des Jours de la semaine 
	 */
	function getLiteralWeekDay($idate, $aconvert = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'))
	{
		return self::getWeekDay($idate, $aconvert);
	}

	/**
	 * microtime()
	 * Renvoi la valeur en microseconde de $itime (Alias de microtime())
	 * @return float
	 * @param int $itime valeur au format num鲩que 
	 */
	public static function microtime($itime = null) {
		list($usec, $sec) = explode(" ", microtime($itime));
    	return dwNumeric::round(((float)$usec + (float)$sec));
	}
	
}