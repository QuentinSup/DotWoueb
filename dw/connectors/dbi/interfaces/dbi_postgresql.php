<?php

namespace dw\connectors\dbi\interfaces;

use dw\connectors\dbi\dbiInterface;
use dw\classes\dwException;

class dbi_postgresql extends dbiInterface
{
	public function connect($shost, $sport, $suser, $spassword, $sdatabase, $aoptions)
	{
		if(isset($aoptions['persistent']) && $aoptions['persistent'])	
		{
			$this -> _reslink = pg_pconnect("host=$shost ".(!empty($sport)?"port=$sport ":"")."dbname=$sdatabase user=$suser password=$spassword");
		} else {
			$this -> _reslink = pg_connect("host=$shost ".(!empty($sport)?"port=$sport ":"")."dbname=$sdatabase user=$suser password=$spassword");
		}
		return $this -> _reslink;
	}
	
	public function disconnect()
	{
		if(!is_null($this -> _reslink))
		{
			return pg_close($this -> _reslink);	
		}
	}

	public function prepareQuery($squery, $aparams = array(), $ioffset = null, $ilimit = null, $bescapequery = true)
	{
		$squery = $this -> setQueryParams($squery, $aparams, '{?}', $bescapequery);
		return $squery.(is_null($ilimit)?'':" LIMIT ".$ilimit.(is_null($ioffset)?'':" OFFSET ".$ioffset));
	}
	
	public function escapeString($svalue)
	{
		return pg_escape_string($svalue);
	}
	
	public function query($squery)
	{
		return pg_query($this -> _reslink, $squery);
	}
	
	public function getClientEncoding()
	{
		return pg_client_encoding($this -> _reslink);
	}
	
	public function getStatus()
	{
		return pg_connection_status($this -> _reslink);
	}
	
	public function fetchArray($res)
	{
		return pg_fetch_array($res);	
	}

	public function fetchAssoc($res)
	{
		return pg_fetch_assoc($res);	
	}

	public function fetchObject($res, $classname = null)
	{
		return pg_fetch_object($res, null,$classname);	
	}
	
	public function getNumRows($res)
	{
		return pg_num_rows($res);
	}
	
	public function getAffectedRows()
	{
		return pg_affected_rows($this -> _reslink);
	}
	
	public function getLastError()
	{
		return;
	}

	public function getLastErrorMessage()
	{
		return pg_last_error($this -> _reslink);
	}

	public function begin()
	{
		return $this -> query("BEGIN");
	}
	
	public function commit()
	{
		return $this -> query("COMMIT");
	}
	public function rollback()
	{
		return $this -> query("ROLLBACK");
	}		
	
	public function getSchemaTable($stablename)
	{
		$ary = null;
		$res =  $this -> query(
			"SELECT relfilenode, attnum, attname FROM pg_class, pg_attribute 
			WHERE attrelid = relfilenode 
			AND attnum > 0 
			AND relname = '$stablename'");
		if($res)
		{
			$ary = array();
			while($data = $this -> fetchAssoc($res))
			{
				$id = $data['relfilenode'];
				$ary['columns'][$data['attnum']] = $data['attname'];
			}
			$res = $this -> query(
				"SELECT * FROM pg_index 
				WHERE indrelid = ".$id." 
				AND indisprimary = 't'");
			if($res)
			{
				if($data = $this -> fetchAssoc($res))
				{
					foreach(explode(" ", $data['indkey']) as $attnum)
					{
						$ary['primaryKey'][] = $ary['columns'][$attnum];
					}  
				}	
			}
		}
		return $ary;
	}

	public function getColumnsInfo($acolumns, $whereAdd = null) { 
		throw new dwException("getColumnsInfo: Fonction non implementees pour PostgreSQL");
	}

	public function getInsertId()
	{
		throw new dwException("getInsertId: Fonction non implementees pour PostgreSQL");
	}

}

?>