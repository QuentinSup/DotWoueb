<?php

namespace dw\connectors\dbi;

use dw\classes\dwObject;
use dw\classes\dwException;

/**
 * G貥 l'interface avec la base de donnees
 * @author Quentin Supernant
 * @version 3.0
 * @package dotWoueb
 */

define('E_DBI_DSN', 401);
define('E_DBI_GEN_ID', 402);
define('E_DBI_CONNECT', 403);
define('E_DBI_QUERY', 404);
define('E_DBI_SELECT_DB', 405);
define('E_DBI_INTERFACE', 406);
define('E_DBI_FACTORY', 407);
define('E_DBI_UNKNOW_ATTRIBUTE', 408);
define('E_DBI_FOREACHROW', 409);
define('DBI_MODE_RELEASE', 0);
define('DBI_MODE_WARN', 1);
define('DBI_MODE_DEBUG', 2);
define('DBI_ENCODING', '');

define('DW_FIELD_TYPE_NUMERIC', 'numeric');
define('DW_FIELD_TYPE_STRING', 'string');
define('DW_FIELD_TYPE_TEXT', 'text');
define('DW_FIELD_TYPE_IMAGE', 'image');
define('DW_FIELD_TYPE_DATE', 'date');
define('DW_FIELD_TYPE_DATETIME', 'datetime');

class dbi_dataObject extends dwObject
{

}

class dbi_dataEntity 
{
	protected $_sentity = null;
	protected $_aprimaryKey = null;
	protected $_aattributes = null;
	protected $_odataSet = null;
	protected $_odb    = null;

	public function __construct($odb, $sentity, $aattributes, $aprimaryKey = null)
	{
		$this -> _odb = $odb;
		$this -> _sentity = $sentity;
		$this -> _aattributes = $aattributes;
		$this -> _aprimaryKey = $aprimaryKey;	
	}
	
	public function __get($sattr)
	{
		if($this -> isAttribute($sattr))
		{
			return $this -> _aattributes[$sattr];
		} else {
			throw new exception(E_DBI_UNKNOW_ATTRIBUTE);
		}
	}

	public function isAttribute($sattr)
	{
		return in_array($sattr, array_keys($this -> _aattributes));
	}
	
	public function isPrimaryKey($sattr)
	{
		return in_array($sattr, $this -> _aprimaryKey);
	}
	
	public function keyExists($akeys = null)
	{
		if(is_null($akeys))
		{
			foreach($this -> _aprimaryKey as $skey)
			{
				if(!is_null($this -> $skey))
				{
					$akeys[$skey] = $this -> $skey;
				}
			}
		}
		if(empty($akeys))
		{
			return null;
		}
		$ods = $this -> _odb -> select($this -> getTableName(), $akeys);
		return $ods -> getNumRows() != 0;
	}
	
	public function get($avalues = null, $bfetch = true)
	{
		$do = clone($this);
		$do -> find($avalues, true);
		return $do;
	}
	
	public function count($avalues = null)
	{
		$this -> setFrom($avalues);	
		return $this -> _odb -> count($this -> getTableName(), $this -> getAttributes(true));
	}
	
	/**
	 * find()
	 * Recherche les enregistrements correspondant aux crit貥s courant de l'objet
	 * 
	 */
	public function find($avalues = null, $orderBy = null, $bfetch = true, $ioffset = null, $ilimit = null, $whereAdd = null)
	{
		$sorderBy = null;
		if(!is_null($orderBy))
		{
			if(is_array($orderBy))
			{
				$sorderBy = "ORDER BY ".implode(", ", $orderBy);
			} else {
				$sorderBy = "ORDER BY ".$orderBy;
			}
		}
		$this -> setFrom($avalues);
		$this -> _odataSet = $this -> _odb -> select($this -> getTableName(), $this -> getAttributes(true), $whereAdd, $sorderBy, $ioffset, $ilimit);
		if($bfetch)
		{
			$this -> fetch();
		}
		return $this -> _odataSet -> getNumRows() > 0;
	}
	
	/**
	 * select()
	 * Alternative ࠬto find()
	 */
	public function select($whereAdd = null, $ioffset = null, $ilimit = null, $orderBy = null)
	{
		return $this -> find(null, $orderBy, true, $ioffset, $ilimit, $whereAdd);
	}
	
	/**
	 * search()
	 * Alternative ࠬto find()
	 */
	public function search($avalues = null, $ioffset = null, $ilimit = null, $orderBy = null)
	{
		return $this -> find($avalues, $orderBy, true, $ioffset, $ilimit);
	}
	
	public function castSql($svalue)
	{
		return "@".$svalue;
	}

	public function __set($sattr, $mvalue)
	{
		if($this -> isAttribute($sattr))
		{
			$this -> _aattributes[$sattr] = $mvalue;
		} else {
			throw new exception(E_DBI_UNKNOW_ATTRIBUTE);
		}
	}
	
	public function getTableName()
	{
		return $this -> _sentity;	
	}
	
	public function getColumns()
	{
		return array_keys($this -> _aattributes);
	}
	
	public function getColumnsInfo()
	{
		return $this -> _odb -> getColumnsInfo($this -> getColumns(), $this -> _sentity);
	}
	
	public function getNextId($id)
	{
		return $this -> _odb -> getNextId($this -> _sentity, $id);
	}
	
	private function _getArrayNotNullValues($array)
	{
		$ary = array();
		foreach($array as $sattr)
		{
			if(!is_null($this -> $sattr) && !(in_array($sattr, $this -> _aprimaryKey) && !$this -> $sattr))
			{
				$ary[$sattr] = $this -> $sattr;
			}
		}
		return $ary;
	}
	
	public function getAttributes($bnotnull = false)
	{
		if($bnotnull)
		{
			return $this -> _getArrayNotNullValues(array_keys($this -> _aattributes), $bnotnull);
		} else {
			return $this -> _aattributes;
		}
	}
	
	public function getPrimaryKeys($bnotnull = false)
	{
		if($bnotnull)
		{
			return $this -> _getArrayNotNullValues($this -> _aprimaryKey, $bnotnull);
		} else {
			return $this -> _aprimaryKey;	
		}
	}
	
	public function toArray()
	{
		return $this -> getAttributes();
	}
	
	public function update($whereAdd = null, $avalues = null)
	{
		$this -> setFrom($avalues);
		return $this -> _odb -> update($this -> _sentity, $this -> getAttributes(true), $this -> _aprimaryKey, $whereAdd);
	}
	
	public function N()
	{
		return $this -> _odataSet -> getNumRows();
	}
	
	public function delete($whereAdd = null, $avalues = null)
	{
		$this -> setFrom($avalues);
		return $this -> _odb -> delete($this -> _sentity, $this -> getAttributes(true), $whereAdd);
	}
	
	public function insert($avalues = null)
	{
		$this -> setFrom($avalues);
		if($this -> _odb -> insert($this -> _sentity, $this -> getAttributes(true)))
		{
			#return $this -> get();
			return true;
		}
		return false;
	}
	
	public function getLastInsertId() 
	{
		return $this -> _odb -> getInsertId();
	}
	
	public function fetch()
	{
		if($this -> _odataSet -> fetch())
		{
			$this -> setFrom($this -> _odataSet -> record -> toArray());
			return true;
		}
		return false;
	}
	
	public function indate($avalues = null)
	{
		$this -> setFrom($avalues);
		if($this -> keyExists())
		{
			return $this -> update();
		} else {
			return $this -> insert();
		}
	}

	private function _setArrayFrom($ary, $aattributes, $ball = true)
	{
		if(is_null($aattributes))
		{
			return;
		}
		foreach($ary as $sattr)
		{
			if(isset($aattributes[$sattr]))
			{
				$this -> $sattr = $aattributes[$sattr]; 
			} elseif($ball) {
				$this -> $sattr = null;
			}
		}	
	}

	public function clearValues($bkeys = false)
	{
		foreach(array_keys($this -> _aattributes) as $sattr)
		{
			if($bkeys || !in_array($sattr, $this -> _aprimaryKey))
			{
				$this -> $sattr = null;
			}
		}	
	}

	public function setKeysFrom($aattributes, $ball = true)
	{
		$this -> _setArrayFrom($this -> _aprimaryKey, $aattributes, $ball);
	}

	public function setFrom($aattributes, $ball = true)
	{
		$this -> _setArrayFrom(array_keys($this -> _aattributes), $aattributes, $ball);
	}
}

class dbi_queryList_item
{
 /** Le DSN de la connexion
   * @var string
   */
  public $dsn;
  
 /** Le temps au moment de l'execution de la requete 
   * @var int
   */
  public $timer;
  
  /** 
   * La requete au format SQL 
   * @var string 
   */
  public $sql;
  
  /** 
   * Indique si la requete est en erreur 
   * @var bool
   */
  public $errNo;
  
  /** 
   * Le message d'erreur si erreur 
   * @var string 
   */
  public $message;
  
  /**
   * Le nombre de resultat de la requete
   * @var int
   */
  public $rows;
  
  /** 
   * Le nombre d'enregistrements affectes par la requete
   * @var int
   */
  public $affectedrows;
  
  /**
   * L'initiateur de la requ괥 (0: system, 1:user)
   * $var int
   */
  public $who;
  
  /**
   * Constructeur
   * @param string $sdsn le DSN de la connexion
   * @param string $ssql le requete au format SQL
   * @param int $ierror indique si la requete est en erreur
   * @param int $iaffectedrow nombre d'enregistrement affectes par la requete
   * @param string $smessage le message d'erreur
   * @param string $irows le nombre de resultats retournes par la requete
   */
  public function __construct($sdsn, $ssql, $ierror, $irows=0, $iaffectedrow=0, $smessage='', $iwho = 1) 
  {
    $this -> timer 		  = 0;
    $this -> dsn   		  = $sdsn;
    $this -> sql   		  = $ssql;
    $this -> errNo        = $ierror;
    $this -> message      = $smessage;
    $this -> rows         = $irows;
    $this -> affectedrows = $iaffectedrow;
    $this -> who		  = $iwho;
   }	
	
}

class dbi_queryList
{
 /** 
   * le nombre de requetes stockees 
   * @var int
   */
  private $_icount;
  
   /** 
   * le tableau de stockage des requetes 
   * @var int
   */
  private $_atabquery;
  
  /**
   * Constructeur
   */
  public function __construct()
  {
   	$this ->_icount = 0;
   	$this->_atabquery = array();
  }
  /**
   * Ajoute une requete
   * @param string $ssql le requete au format SQL
   * @param bool $berror indique si la requete est en erreur
   * @param int $iaffectedrow nombre d'enregistrement affectes par la requete
   * @param string $smessage le message d'erreur
   * @return int l'indice de la requete
   */
  public function &add($ssql, $berror, $iresults=0, $iaffectedrow=0, $smessage='', $iwho = 1) 
  {
    $query = new dbi_queryList_item($ssql, $berror, $iresults, $iaffectedrow, $smessage, $iwho);
    $this -> _atabquery[] = $query;
    $this -> _icount++;
    return $query;
  }
  
  /**
   * Retourne le temps d'execution de toutes les requetes
   * @return le temps d'execution total
   */
  private function getTotalTime() 
  {
    $tot = 0;
    for($i = 0; $i < $this -> _icount; $i++) {
      $tot += $this -> _atabquery[$i] -> timer;
    }
    return $tot;
  }
  
  public function getNumQueries()
  {
  	return $this -> _icount;
  }
  
  public function toArray() 
  {
  	$aqueries = array();
  	foreach($this->_atabquery as $query)
  	{
  		$aqueries["queries"][] = array(
  				"dsn"	  => $query -> dsn,
				"sql" 	  => $query -> sql,
				"error"   => $query -> errNo,
				"message" => $query -> message,
				"count"	  => $query -> rows,
				"affectedrows" => $query -> affectedrows,
				"timer"		   => $query -> timer);
		$aqueries["count"]	= $this -> _icount;
		$aqueries["timer"]	= $this -> getTotalTime();	
  	}
  	return $aqueries;
 }
}

class dbi_dataSet
{
	protected $_ores   = null;
	protected $_odb    = null;
	protected $_squery = '';
	public $record  = null;

	public function __construct($odb, $squery, $ores)
	{
		$this -> _odb    = $odb;
		$this -> _ores   = $ores;
		$this -> _squery = $squery;
	}
	
	public function fetchArray()
	{
		return $this -> _odb -> fetchArray($this -> _ores);	
	}

	public function fetchAssoc()
	{
		return $this -> _odb -> fetchAssoc($this -> _ores);	
	}

	public function fetch()
	{
		unset($this -> record);
		$this -> record = $this -> _odb -> fetchObject($this -> _ores, 'dw\connectors\dbi\dbi_dataObject');
		return $this -> record;	
	}
	
	public function toArray()
	{
		return $this -> record -> toArray();
	}

	public function f($svar)
	{
		if(is_null($this -> record))
		{
			$this -> fetch();
		}
		return $this -> record -> $svar;
	}

	public function getNumRows()
	{
		return @$this -> _odb -> getNumRows($this -> _ores);
	}
	
	public function getAffectedRows()
	{
		return $this -> _odb -> getAffectedRows();
	}

	public function getQuery()
	{
		return $this -> _squery;
	}

	public function getResource()
	{
		return $this -> _ores;
	}
	
	public function __get($sattr)
	{
		return $this -> f($sattr);
	}
	
}

class dbi
{
  /**@#+*/
	protected static $_imode = DBI_MODE_RELEASE;
	protected static $_oqueries = null;
	
	protected $_fstartquery = null;
	protected $_fendquery = null;
	
	protected static $_acacheSchemaTable = array();
	protected static $_currentConnection = null;
	
	protected static $_bforeachrow = true;
	protected static $_bcachingEntityDef = false;
	protected static $_sentityDefDir = "./";
	
  /** 
   * le nom du serveur 
   * @var string 
   */
  protected $_sserver;
  
  /** 
   * le nom de l'utilisateur
   * @var string 
   */
  protected $_suser;
  
   /** le mot de passe  
   * @var string 
   */
  protected $_spassword;
  
   /** la base de donnees  
   * @var string 
   */
  protected $_sdatabase;
  
   /** le type de base de donnees  
   * @var string 
   */
  protected $_stype;
  
   /** le port
   * @var int 
   */
  protected $_iport;
   /** le type d'encodage  
   * @var string 
   */
  protected $_sencode = DBI_ENCODING;
  
  /** l'objet de connexion a la bases 
   * @var DB 
   */
  protected $_odb;
  
  /**#@-*/
  
  /**
   * FEAR = For EAch Row
   * la variable FEAR est une s飵rit頥mp꣨ant la mise ࠪour ou la suppression de l'ensemble 
   * des enregistrements d'une table
   */
  public static function setFEAR($bvalue)
  {
  	self::$_bforeachrow = $bvalue;
  }
  
  public static function prepare($imode = DBI_MODE_DEBUG)
  {
		self::$_oqueries = new dbi_queryList();
		self::setMode($imode);
  }
  
  public static function singleton()
  {
  		if(is_null(self::$_currentConnection))
  		{
  			return new dbi();	
  		} else {
  			return self::getCurrentConnection();
  		}
  }
  
  /**
   * D馩ni le mode courant
   * @param int $imode Nouveau mode (DBI_MODE_RELEASE, DBI_MODE_WARN, DBI_MODE_DEBUG)
   */
  public static function setMode($imode = DBI_MODE_RELEASE)
  {
  	self::$_imode = $imode;
  }
  
  /**
   * Renvoi le mode courant
   * @return int $imode le mode (DBI_MODE_RELEASE, DBI_MODE_WARN, DBI_MODE_DEBUG)
   */
  public static function getMode()
  {
  	return self::$_imode;
  }
 
   /**
   * Constructeur de l'objet. Se connecte a la base de donnees
   * @param array $aparams tableau contenant les informations d'authentification sous la forme :
   * - S => nom d'hote du serveur ou son ip
   * - U => nom d'utilisateur
   * - P => mot de passe de connexion
   * - D => nom de la base de donnees
   */
  public function __construct($aparams = null, $bautoconnect = false)
  {
  	if(!is_null($aparams))
  	{
  		$this -> setParams($aparams);
	  	if($bautoconnect) 
	  	{
	  		$this -> connect();
	  	}
  	}
  }
  
  /**
   * Prepare le texte pour une insertion en effectuant une conversion en UTF8 si necessaire.
   * @param string $svalue la valeur
   * @return string la valeur convertie pour l'insertion
   */
  public static function formatValue($svalue) {
    $svalue = !get_magic_quotes_gpc()?addslashes($svalue):$svalue;
    $svalue = html_entity_decode($svalue);
    switch(strtoupper($this -> _sencode)) {
      case 'UTF8':  return utf8_encode($svalue);
      case 'ISO' :  
      default:
      				return $svalue;
    }
  }
  /**
   * Prepare le texte pour une impression ecran
   * @param string $svalue la valeur 
   * @return string la valeur preparee pour l'affichage a l'ecran
   */
  public static function displayValue($svalue) {
    $svalue = htmlentities($svalue);
    switch(strtoupper($this -> _sencode)) {
      case 'UTF8':  return utf8_decode($svalue);
      case 'ISO' :  
      default:
      				return $svalue;
    } 
  }
  
  public function getMaxId($sentity, $sfieldid)
  {
  	$ores = $this -> query("SELECT MAX(".$sfieldid.") as id FROM ".$sentity);
	if(!is_null($ores))
	{
		if($ores -> fetch())
		{
			return $ores -> record -> id;	
		} else {
			return 0;	
		}
	} else {
		throw new exception(E_DBI_GEN_ID);	
	}
  }
  
  public function getNextId($sentity, $sfieldid)
  {
  	return (int)$this -> getMaxValue($sentity, $sfieldid) + 1;
  }
  
  /**
   * Se connecte a la base de donnees
   * @param array $aparams tableau contenant les informations d'authentification sous la forme :
   * - S => nom d'hote du serveur ou son ip
   * - U => nom d'utilisateur
   * - P => mot de passe de connexion
   * - D => nom de la base de donnees
   */
   
  public function setParams($aparams)
  {
	if(is_array($aparams)) 
	{
      $akeys = array_keys($aparams);
      foreach($akeys as $skey) 
      {
        switch($skey) {
          case 'SERVER':
          case 'S'     :
          case 'SRV'   : $this -> _sserver   = $aparams[$skey]; 
          				break;
          case 'USER'  :
          case 'U'     :
          case 'USR'   : $this -> _suser     = $aparams[$skey]; 
          				break;
          case 'PASSWORD':
          case 'P'     :
          case 'PWD'   : $this -> _spassword = $aparams[$skey];
          				break;
          case 'DATABASE':
          case 'D'     :
          case 'DB'    : $this -> _sdatabase = $aparams[$skey]; 
          				break;
          case 'TYPE': 
          case 'T': 	$this -> _stype = $aparams[$skey];
          				break;
          case 'PORT':  $this -> _iport = $aparams[$skey];
        }
      }
    } else {
    	$dsninfo = self::parseDSN($aparams);
    	$this -> _stype  	 = $dsninfo['dbtype'];
    	$this -> _suser 	 = $dsninfo['username'];
    	$this -> _spassword  = $dsninfo['password'];
    	$this -> _iport 	 = $dsninfo['port'];
    	$this -> _sdatabase  = $dsninfo['database'];
    	$this -> _sserver 	 = $dsninfo['host'];
	}
  }
  
  
  public static function parseDSN($sDSN)
  {
        if(preg_match("/(.*):\/\/(.*)@(.*)\/(.*)/", $sDSN, $res))
        {
        	$userpass = explode(':', $res[2]);
        	$hostport = explode(':', $res[3]);
        	return array(
	            'dbtype'   => $res[1],
	            'username' => @$userpass[0],
	            'password' => @$userpass[1],
	            'host'     => @$hostport[0],
	            'port'     => @$hostport[1],
	            'database' => $res[4]
        	);
        } else {
        	throw new exception(E_DBI_DSN);
        }
  }
  
  public function getDSN() {
  	return $this->_stype."://".$this -> _suser.":".$this -> _spassword."@".$this -> _sserver.":".$this -> _iport."/".$this -> _sdatabase;
  }
  
  public function getInterface() {
  	return $this -> _odb;
  }
  
  static public function getQueries() {
  	return self::$_oqueries;
  }

  static function test_connect($sdsn)
  {
 	$db = new dbi();
 	try
 	{
 		$db -> connect($sdsn);
 		return true;
 	} catch(exception $e)
 	{
 		return $e -> getMessage();
 	}
  }

  public function connect($aparams = null, $aoptions = array()) 
  {
  	unset($this->_odb);
    if(!is_null($aparams)) 
    {
    	$this -> setParams($aparams);
    }
    if(!empty($this -> _stype))
    {
		$className = 'dw\connectors\dbi\interfaces\dbi_'.$this -> _stype;
	    if(!class_exists($className))
	    {
	    	require_once(dirname(__FILE__).'/interfaces/dbi_'.$this -> _stype.'.php');
	   		if(!class_exists($className))
	   		{
	   			throw new dwException(E_DBI_INTERFACE);	
	   		}
	    }
    	$this -> _odb = new $className();
    	if(!$this -> _odb -> connect($this -> _sserver, $this -> _iport, $this -> _suser, $this -> _spassword, $this -> _sdatabase, $aoptions))
    	{
    		throw new dwException(E_DBI_CONNECT);	
    	}
    	self::$_currentConnection = $this;
    } else {
    	throw new dwException(E_DBI_DSN);
    }
  } 
  /**
   * Execute une requete SQL
   * @param string $squery la requete a executer
   * @return dbi_dataSet
   */
  public function &query($squery, $aparams = array(), $ioffset = null, $ilimit = null, $bescapequery = true, $iwho = 1) 
  {
 	if($ilimit == 0) 
 	{
 		$ilimit = null;
 	}
	  
  	$squery  = $this -> _odb -> prepareQuery($squery, $aparams, $ioffset, $ilimit, $bescapequery);
  	$idquery = $this -> _startQuery($squery);
  	$ores    = $this -> _odb -> query($squery, $ioffset, $ilimit);
  	if(!$ores === false)
  	{
  		$ods 	 = new dbi_dataSet($this -> _odb, $squery, $ores);
  		$this -> _endQuery($idquery, $squery, $ods, $iwho);
    	return $ods;
  	} else {
  		$this -> _endQuery($idquery, $squery, null, $iwho);
  		throw new dwException($this -> _odb -> getLastErrorMessage(), E_DBI_QUERY);
  	}  
  }

 	/**
 	 * select()
 	 * Effectue une requ괥 de s鬥ction
 	 * @param string $sentity nom de la table
 	 * @param array $aattributes tableau associatif column => value des champs ࠭ette ࠪour
	 * @param string $whereAdd clause SQL WHERE complémentaire
 	 * @param string $squeryEnd clause SQL en fin de requ괥 (exemple : ORDER BY ...) 
 	 * @param string $mselectList Liste de champs de la clause Select
 	 * @param int	 $ioffset
 	 * @param int 	 $ilimit
	 * @param string $mselectList Liste de champs de la clause Select
 	 * @return dbi_dataSet
 	 */
	public function select($sentity, $aattributes, $whereAdd = null, $squeryEnd = null, $ioffset = null, $ilimit = null, $mselectList = '*')
	{
		$awhere = array();
		if(is_array($mselectList))
		{
			$mselectList = implode(', ', $mselectList);
		}
		foreach(array_keys($aattributes) as $sattr)
		{
			$awhere[] = $sattr." = '".$this -> _odb -> escapeString($aattributes[$sattr])."'";
		}
		$wherePart = (!empty($awhere)?" WHERE ".implode(' AND ', $awhere):"");
		if(!is_null($whereAdd)) {
			if(is_string($whereAdd)) {
				$wherePart .= ($wherePart == ""?" WHERE ".$whereAdd:' AND '.$whereAdd);
			} else {
				foreach($whereAdd as $whereStr) {
					$wherePart .= ' AND '.$whereStr;
				}
			}
		}

		return $this -> query("SELECT {?} FROM {?} ".$wherePart.(!is_null($squeryEnd)?" ".$squeryEnd:""), array($mselectList, $sentity), $ioffset, $ilimit);
	}
	
	/**
 	 * count()
 	 * Effectue une requ괥 de s鬥ction
 	 * @param string $sentity nom de la table
 	 * @param array $aattributes tableau associatif column => value des champs ࠭ette ࠪour
 	 * @param string $squeryEnd clause SQL en fin de requ괥 (exemple : ORDER BY ...) 
 	 * @param string $mselectList Liste de champs de la clause Select
 	 * @return dbi_dataSet
 	 */
	public function count($sentity, $aattributes, $scountAttr = '*')
	{
		$awhere = array();
		foreach(array_keys($aattributes) as $sattr)
		{
			$awhere[] = $sattr." = '".$this -> _odb -> escapeString($aattributes[$sattr])."'";
		}
		$ods = $this -> query("SELECT COUNT({?}) AS DBICOUNT FROM {?} ".(!empty($awhere)?" WHERE ".implode(' AND ', $awhere):""), array($scountAttr, $sentity));
		return (int)$ods -> f('DBICOUNT');
	}

 	/**
 	 * update()
 	 * Effectue une requ괥 de mise ࠪour
 	 * @param string $sentity nom de la table
 	 * @param array $aattributes tableau associatif column => value des champs ࠭ette ࠪour
 	 * @param array $akeys liste des cl鳠primaires de la table (pour la clause Where) 
 	 * @param string $whereAdd clause Where de la requ괥
 	 * @return dbi_dataSet
 	 */
	public function update($sentity, $aattributes, $akeys = array(), $whereAdd = null)
	{
		$aSet = array();
		$aWhere = array();
		foreach(array_keys($aattributes) as $sattr)
		{
			if(substr($aattributes[$sattr], 0, 1) == "@")
			{
				$sql = $sattr." = ".$this -> _odb -> escapeString(substr($aattributes[$sattr], 1));	
			} else {
				$sql = $sattr." = '".$this -> _odb -> escapeString($aattributes[$sattr])."'";
			}
			if(!in_array($sattr, $akeys))
			{
				$aSet[] = $sql;
			} else {
				$aWhere[] = $sql;
			}
		}
		if(!is_null($whereAdd))
		{
			$aWhere[] = $whereAdd;	
		}
		if(self::$_bforeachrow && empty($aWhere))
		{
			throw new exception(E_DBI_FOREACHROW);
		}
		$swhere = implode(' AND ', $aWhere);
		return $this -> query("UPDATE {?} SET ".implode(", ", $aSet).(!empty($swhere)?" WHERE ".$swhere:""), array($sentity));
	}
 
  	/**
 	 * delete()
 	 * Effectue une requ괥 de suppression
 	 * @param string $sentity nom de la table
 	 * @param array $aattributes tableau associatif column => value des champs ࠭ette ࠪour 
 	 * @param string $whereAdd clause Where de la requ괥
 	 * @return dbi_dataSet
 	 */
 	public function delete($sentity, $aattributes = array(), $whereAdd = null)
 	{
		$aWhere = array();
		foreach(array_keys($aattributes) as $sattr)
		{
			if(substr($aattributes[$sattr], 0, 1) == "@")
			{
				$sql = $sattr." = ".$this -> _odb -> escapeString(substr($aattributes[$sattr], 1));	
			} else {
				$sql = $sattr." = '".$this -> _odb -> escapeString($aattributes[$sattr])."'";
			}
			$sql = $sattr." = '".$this -> _odb -> escapeString($aattributes[$sattr])."'";
			{
				$aWhere[] = $sql;
			}
		}
		if(!is_null($whereAdd))
		{
			$aWhere[] = $whereAdd;	
		}
		if(self::$_bforeachrow && empty($aWhere))
		{
			throw new exception(E_DBI_FOREACHROW);
		}
		$swhere = implode(' AND ', $aWhere);
		return $this -> query("DELETE FROM {?} ".(!empty($swhere)?" WHERE ".$swhere:""), array($sentity));
 	}
 	
   	/**
 	 * insert()
 	 * Effectue une requ괥 d'insertion
 	 * @param string $sentity nom de la table
 	 * @param array $aattributes tableau associatif column => value des champs ࠭ette ࠪour 
 	 * @return dbi_dataSet
 	 */
  	public function insert($sentity, $aattributes)
 	{
 		$aKeys = array_keys($aattributes);
 		$aValues = array();
		foreach($aKeys as $sattr)
		{
			if(substr($aattributes[$sattr], 0, 1) == "@")
			{
				$aValues[] = $this -> _odb -> escapeString(substr($aattributes[$sattr], 1));	
			} else {
				$aValues[] = "'".$this -> _odb -> escapeString($aattributes[$sattr])."'";
			}
		}
		return $this -> query("INSERT INTO {?}(".implode(',', $aKeys).") VALUES(".implode(", ", $aValues).")", array($sentity));
 	}
 	
 	public function insertInto($sentity, $avalues)
 	{
 		$do = $this -> factory($sentity, $avalues);
 		$do -> insert();
 		return $do;
 	}
 
  	public function updateInto($sentity, $avalues)
 	{
 		$do = $this -> factory($sentity, $avalues);
 		$do -> update();
 		return $do;
 	}
 	
  	public function deleteInto($sentity, $avalues)
 	{
 		$do = $this -> factory($sentity, $avalues);
 		$do -> delete();
 		return $do;
 	}
 	
 	public function indateInto($sentity, $avalues)
 	{
 		$do = $this -> factory($sentity, $avalues);
 		$do -> indate();
 		return $do;
 	}
 
  /**
   * Renvoi la derni貥 erreur. 
   */
  public function getLastError() 
  {
  	return $this -> _odb -> getLastError();  
  }
  
  /**
   * Demarre une transaction
   */
  public function startTransaction() 
  {
  	return $this -> _odb -> begin();
  }
  /**
   * Valide la transaction en cours
   */
  public function endTransaction($rollback = false) 
  {
  	if($rollback)
  	{
  		return $this -> commit();	
  	} else {
  		return $this -> rollback();
  	}
  }

	public function getInsertId() {
		return $this -> _odb -> getInsertId();
	}
	
  /**
   * Annule la transaction en cours
   */
  public function rollback() 
  {
  	return $this -> _odb -> rollback();
  }

  public function commit() 
  {
  	return $this -> _odb -> commit();
  }
 
  /**
   * Effectue les traitements necessaires avant l'execution d'une requete
   * @param string $squery requ괥 SQL
   * @return mixed identifiant personnalis頤e la requ괥
   */
  private function _startQuery($query)
  {
  	$idquery = null;
  	if(function_exists($this -> _fstartquery))
  	{
  		$func = $this -> _fstartquery;
  		$func($this, $idquery, $query);
  		return $idquery;
  	}
  }
  
  /**
   * Effectue les traitements necessaires apres l'execution d'une requete :
   * @param mixed $idquery idenfiant personnalis頤e la requ괥 (renvoy頰ar _startQuery())
   * @param dbi_dataSet $ods r鳵ltat de la requ괥
   */
  private function _endQuery($idquery, $ssql, $ods, $iwho = 1)
  {
  	if(function_exists($this -> _fendquery))
  	{
  		$func = $this -> _fendquery;
  		return $func($this, $idquery, $ods);
  	}
  	if(self::getMode() != DBI_MODE_RELEASE)
  	{
  		switch(self::getMode())
  		{
  			case DBI_MODE_WARN : if(!$this -> _odb -> getLastError()) { break; }
  			case DBI_MODE_DEBUG: 	
  									self::$_oqueries -> add(
  										$this -> getDSN(),
  										$ssql,
  										$this -> _odb -> getLastError(),
  										(is_null($ods)?0:$ods -> getNumRows()),
  										(is_null($ods)?0:$ods -> getAffectedRows()),
  										$this -> _odb  -> getLastErrorMessage(), $iwho);
  		}
  	}
  }
  
  public static function getCurrentConnection()
  {
  	return self::$_currentConnection;
  }
  
  public function getSchemaTable($stable, $buseCache = true)
  {
  		if(!$buseCache || !isset(self::$_acacheSchemaTable[$stable]))
  		{
  			$adefs = $this -> _odb -> getSchemaTable($stable);
  			self::$_acacheSchemaTable[$stable] = $adefs;
  		}
  		return self::$_acacheSchemaTable[$stable];
  }
  
  public function factory($stable, $adefaultValues = null)
  {
  		$do = null;
  		$stable = strtolower($stable);
  		$sEntityDefFile = self::$_sentityDefDir.$stable.".entity";
  		if(self::$_bcachingEntityDef)
  		{
 			require_once($sEntityDefFile);
  		} elseif(file_exists($sEntityDefFile))
  		{
  			unlink($sEntityDefFile);
  		}
  		if(!class_exists($stable."Entity"))
  		{
	  		$adef = $this -> getSchemaTable($stable);
	  		if(!is_null($adef))
	  		{
	  			$classDef = '
class '.$stable.'Entity extends dw\connectors\dbi\dbi_dataEntity
{

	public function __construct($odb)
	{
		parent::__construct($odb, \''.$stable.'\', array(\''.implode("' => null,'", $adef['columns']).'\' => null), array(\''.implode("','", $adef['primaryKey']).'\'));
	}

}';
	  			 if(self::$_bcachingEntityDef)
  				 {
  				 	$sFileContent = 
"<?php\n
/**
 * Dénition de l'entitée Ce fichier est généutomatiquement pour optimisation
 * Toute modifications de ce fichier seront écrasées */ \n ".$classDef."\n?>";
	  				file_put_contents($sEntityDefFile, $sFileContent);
	  				require($sEntityDefFile);
	  			 } else {
	  				eval($classDef);
  				 }
	  		} else {
	  			throw new exception(E_DBI_FACTORY);	
	  		}
  		}
	  	$classEntity = $stable.'Entity';
  		$do = new $classEntity($this);
  		if(!is_null($adefaultValues))
  		{
  			$do -> setFrom($adefaultValues, true);
  		}
  		return $do;
  }
  
  public function getColumnsInfo($acolumns, $stablename = null, $whereAdd = null)
  {
  		return $this -> _odb -> getColumnsInfo($acolumns, $whereAdd, $this -> _sdatabase, $stablename);
  }
  
  public static function setCachingEntityDef($bcaching, $sdir = null)
  {
  		self::$_bcachingEntityDef = $bcaching;
  		if(!is_null($sdir))
  		{
  			self::setEntityDefDir($sdir);
  		}
  }
  
  public static function getCachingEntityDef()
  {
  		return self::$_bcachingEntityDef;
  }

  public static function setEntityDefDir($sdir)
  {
  		self::$_sentityDefDir = $sdir;
  }
  
  public static function getEntityDefDir()
  {
  		return self::$_sentityDefDir;
  }
  
}
?>
