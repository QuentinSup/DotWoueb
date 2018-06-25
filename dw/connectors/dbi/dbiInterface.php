<?php

namespace dw\connectors\dbi;

abstract class dbiInterface
{
	protected $_reslink = null;

	public abstract function connect($shost, $sport, $suser, $spassword, $sdatabase);
	public abstract function pconnect($shost, $sport, $suser, $spassword, $sdatabase);
	public abstract function disconnect();
	public abstract function prepareQuery($squery, $aparams = array(), $ioffset = null, $ilimit = null);
	public abstract function escapeString($svalue);
	public abstract function query($squery);
	public abstract function getClientEncoding();
	public abstract function getStatus();
	public abstract function fetchArray($res);
	public abstract function fetchAssoc($res);
	public abstract function fetchObject($res, $classname = null);
	public abstract function getNumRows($res);
	public abstract function getAffectedRows();
	public abstract function getLastError();
	public abstract function getLastErrorMessage();
	public abstract function begin();
	public abstract function commit();
	public abstract function rollback();
	public abstract function getSchemaTable($stablename);
	public abstract function getColumnsInfo($acolumns, $whereAdd = null);
	public abstract function getInsertId();
	
	public function __destruct()
	{
		if(!is_null($this -> _reslink))
		{
			$this -> disconnect();	
		}
	}

	public function setQueryParams($squery, &$aparams, $schar = '{?}', $bescape = true)
	{
		$tmp = '';
	  	$aquery = explode($schar, $squery);
	  	for($i = 0; $i < count($aquery); $i++)
	  	{
	  		$tmp .= $aquery[$i].(isset($aparams[$i])?($bescape?$this -> escapeString($aparams[$i]):$aparams[$i]):'');
	  	}
	  	return $tmp;
	}

	public function get($scmd, $mres)
	{
		return $scmd($mres);
	}
		
}