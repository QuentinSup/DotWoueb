<?php

namespace dw\connectors\dbi\interfaces;

use dw\connectors\dbi\dbiInterface;

class dbi_mysql extends dbiInterface
{
	public function connect($shost, $sport, $suser, $spassword, $sdatabase, $aoptions)
	{
		if(isset($aoptions['persistent']) && $aoptions['persistent'])	
		{
			$this -> _reslink = mysql_pconnect($shost.':'.$sport, $suser, $spassword);
		} else {
			$this -> _reslink = mysql_connect($shost.':'.$sport, $suser, $spassword);
		}
		if($this -> _reslink && !empty($sdatabase))
		{
			$this -> selectdb($sdatabase);
		}
		return $this -> _reslink;
	}

	public function selectdb($sdatabase)
	{
		return mysql_select_db($sdatabase, $this -> _reslink);
	}
	
	public function disconnect()
	{
		if(!is_null($this -> _reslink))
		{
			return mysql_close($this -> _reslink);	
		}
	}

	public function prepareQuery($squery, $aparams = array(), $ioffset = null, $ilimit = null, $bescapequery = true)
	{
		$squery = $this -> setQueryParams($squery, $aparams, '{?}', $bescapequery);
		return $squery.(is_null($ilimit)?'':" LIMIT ".$ilimit.(is_null($ioffset)?'':" OFFSET ".$ioffset));
	}
	
	public function escapeString($svalue)
	{
		if($this -> _reslink)
		{
			return mysql_real_escape_string($svalue, $this -> _reslink);
		} else {
			return mysql_escape_string($svalue);
		}
	}
	
	public function query($squery)
	{
		return mysql_query($squery, $this -> _reslink);
	}
	
	public function getClientEncoding()
	{
		return mysql_client_encoding($this -> _reslink);
	}
	
	public function getStatus()
	{
		return mysql_stat($this -> _reslink);
	}
	
	public function fetchArray($res)
	{
		return mysql_fetch_array($res);	
	}

	public function fetchAssoc($res)
	{
		return mysql_fetch_assoc($res);	
	}

	public function fetchObject($res, $classname = null)
	{
		return mysql_fetch_object($res, $classname);	
	}
	
	public function getNumRows($res)
	{
		return mysql_num_rows($res);
	}
	
	public function getAffectedRows()
	{
		return mysql_affected_rows($this -> _reslink);
	}
	
	public function getLastError()
	{
		return mysql_errno($this -> _reslink);
	}

	public function getLastErrorMessage()
	{
		return mysql_error($this -> _reslink);
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
		$res = $this -> query("SHOW COLUMNS FROM ".$stablename);
		if($res)
		{
			$ary = array();
			while($data = $this -> fetchAssoc($res))
			{
				if($data['Key'] == "PRI")
				{
					$ary['primaryKey'][] = $data['Field'];
				}
				$ary['columns'][] = $data['Field'];
			}
		}
		return $ary;
	}

	public function getColumnsInfo($acolumns, $whereAdd = null, $sschema = null, $stablename = null)
	{
		$ary = null;
		if(!is_null($sschema))
		{
			$whereAdd = (!empty($whereAdd)?"":" AND ")."table_schema = '".$sschema."'";
		}
		if(!is_null($stablename))
		{
			$whereAdd = (!empty($whereAdd)?"":" AND ")."table_name = '".$stablename."'";
		}
		$res = $this -> query("SELECT * FROM information_schema.COLUMNS WHERE column_name IN ('".(is_array($acolumns)?implode("','", $acolumns):$acolumns)."')".(is_null($whereAdd)?"":" AND ".$whereAdd));
		if($res)
		{		
			while($data = $this -> fetchAssoc($res))
			{
				$ary[$data['COLUMN_NAME']] = array("name" 		=> $data['COLUMN_NAME'],
							   "table" 		=> $data['TABLE_NAME'],
							   "schema" 	=> $data['TABLE_SCHEMA'],
							   "type" 		=> $data['DATA_TYPE'],
							   "dwType" 	=> $this -> equivDwType($data['DATA_TYPE']), 
							   "defaultValue" => $data['COLUMN_DEFAULT'],
							   "notNull" 	=> $data['IS_NULLABLE'] == 'NO',
							   "maxLength" 	=> $data['CHARACTER_MAXIMUM_LENGTH'],
							   "precision" 	=> $data['NUMERIC_PRECISION'],
							   "comment"	=> $data['COLUMN_COMMENT'],
							   "primaryKey" => $data['COLUMN_KEY'] == 'PRI');
			}
		}
		return $ary;
	}
	
	public function equivDwType($columnType)
	{
		switch(strtoupper($columnType))
		{
                case "TINYINT":
                case "SMALLINT":
                case "MEDIUMINT":
                case "INT":
                case "BIGINT":
                case "FLOAT":
                case "DOUBLE":
                case "DECIMAL":		return DW_FIELD_TYPE_NUMERIC;
                case "DATETIME":
                case "TIMESTAMP":	return DW_FIELD_TYPE_DATETIME;
                case "DATE":
                case "TIME":
                case "YEAR": 		return DW_FIELD_TYPE_DATE;
                case "TEXT":
                case "TINYBLOB":
                case "TINYTEXT":
                case "BLOB":
                case "MEDIUMBLOB":
                case "MEDIUMTEXT":
                case "LONGBLOB":
                case "LONGTEXT":	return DW_FIELD_TYPE_TEXT;
                case "ENUM":
                case "VARCHAR":
                case "CHAR":
                case "SET":
                case "BINARY":
                case "VARBINARY":
				default : 			return DW_FIELD_TYPE_STRING;
		}	
	}

	public function getInsertId()
	{
		return mysql_db_query($this -> _reslink);
	}

}

?>