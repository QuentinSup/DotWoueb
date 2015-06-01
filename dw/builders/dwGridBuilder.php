<?php

define('E_GRID_DBI', 301);
define('E_GRID_FIELD_EXIST', 302);
define('E_GRID_FIELD_DONT_EXIST', 303);
define('E_GRID_COL_ERROR', 304);

/**
 * @name dwGrid_object
 * @author Quentin Supernant
 * @version 3.0
 * @since 10 avr. 2006
 */

class dwGrid_object {
	/**
	 * @name set
	 * @version 1.0
	 * @since 10 avr. 2006
	 * @param array properties
	 * @example $this -> set(array("property" => "value"));
	 */
	function set($aproperties) 
	{
		if(is_array($aproperties))
		{
			foreach(array_keys($aproperties) as $property)
			{
				$this -> $property = $aproperties[$property];
			}
		}
	}
	
	function get()
	{
		return get_object_vars($this);
	}
	
	function __construct($aproperties = array())
	{
		$this -> set($aproperties);
	}
}

/**
 * @name dwGrid_field
 * @author Quentin Supernant
 * @version 1.0
 * @since 10 avr. 2006
 * @param string fieldname libelle de la colonne
 * @param string fieldindex identifiant du champ de la colonne (unique)
 * @param bool allowfilter autorise le filtre sur ce champ
 * @param bool allowsort autorise le tri sur ce champ
 * @param bool visible affiche le libelle de la colonne (fieldname)
 * @param classname style css de presentation des donnees a l ecran
 * @param enum type type de donnees du champ (int, string, date)
 */
class dwGrid_field extends dwGrid_object {
  public $name   		 = '';       
  public $caption   	 = true;    
  public $filtered 	     = true;              
  public $sorted	     = true;       
  public $HTMLAttributes = null;       
  public $type			 = DW_FIELD_TYPE_STRING;
  public $src			 = null;
  public $href			 = null;
  public $printed		 = true;
  public $defaultvalue   = null;
  public $visible	     = true;
  public $protected		 = false;

  function __construct($sname = '', $scaption = '', $aproperties = array()) 
  { 
    $this -> name      = $sname;
    $this -> caption   = $scaption;
    $this -> set($aproperties);
  }
}

class dwGrid_requester extends dwGrid_object {
	public $clauseSelect   = array();
	public $clauseFrom     = array();
	public $clauseWhere	   = array();
	public $clauseSort	   = array();
	public $odb		 	   = null;
	
	public function __construct($mdb)
	{
		if(is_object($mdb))
		{
			if(get_class($mdb) == 'dbi' || is_subclass_of($mdb, 'dbi'))
			{
				$this -> odb = $mdb;
			} else {
				throw new exception(E_GRID_DBI);
			}
		} else {
			$this -> odb = new dbi($mdb, true);
		}
	}
	
	public function query($ioffset = null, $ilimit = null)
	{
		if(empty($this -> clauseSelect))
		{
			$select = "*";	
		} else {
			$select = implode(' , ', $this -> clauseSelect);
		}
		$from   = implode(' , ', $this -> clauseFrom);
		$where  = implode(' AND ', $this -> clauseWhere);
		$sort   = implode(', ', $this -> clauseSort);
		$sql = 'SELECT ? FROM ?'.(!empty($where)?' WHERE ? ':' ').'?';
		return $this -> odb -> query($sql, array(
															$select, 
															$from, 
															$where,
															$sort), $ioffset, $ilimit, false);
	}
	
	public function sortAdd($ssort, $aparams = array())
	{
		if(!empty($ssort))
		{
			$this -> clauseSort[] = $this -> odb -> getInterface() -> setQueryParams($ssort, $aparams);
		} 
	}
	
	public function whereAdd($swhere, $aparams = array())
	{
		if(!empty($swhere))
		{
			$this -> clauseWhere[] = $this -> odb -> getInterface() -> setQueryParams($swhere, $aparams);
		}
	}
	
	public function selectAdd($sselect, $aparams = array())
	{
		if(!empty($sselect))
		{
			$this -> clauseSelect[] = $this -> odb -> getInterface() -> setQueryParams($sselect, $aparams);
		}
	}
	
	public function fromAdd($sfrom, $aparams = array())
	{
		if(!empty($sfrom))
		{
			$this -> clauseFrom[] = $this -> odb -> getInterface() -> setQueryParams($sfrom, $aparams);
		}
	}
	
}

class dwGrid_options extends dwGrid_object {
	public $filter 		   = true;
	public $sort   		   = true;
	private $_irowsperpage = 0;
	
	public function setRowsPerPage($irpp)
	{
		$this -> _irowsperpage = abs($irpp);
	}
	
	public function getRowsPerPage()
	{
		return $this -> _irowsperpage;
	}
}

class dwGrid_view extends dwGrid_object {
	
	private $_adata		= array();

	public $options 		= null;
	public $count			= 0;
	public $offset  		= 0;
	public $limit 			= 0;
	public $selcol	    	= '';
	public $sort			= '';
	
	public function __construct($aoptions = array())
	{
		$this -> options = new dwGrid_options($aoptions);
	}
	
	public function getPageNo()
	{
		return max(($this -> limit != 0?floor(($this -> offset + 1) / $this -> limit) + (($this -> offset + 1) % $this -> limit == 0?0:1):1), 1);
	}
	
	public function getNumPages()
	{
		return max(($this -> limit != 0?floor($this -> count / $this -> limit) + ($this -> count % $this -> limit == 0?0:1):1), 1);
	}
	
	public function getNextPage($bloop = false)
	{
		if($this -> getPageNo() < $this -> getNumPages())
		{
			return $this -> getPageNo() + 1; 
		} elseif($bloop) {
			return 1;
		} else {
			return $this -> getPageNo();
		}
	}
	
	public function getPreviousPage($bloop = false)
	{
		if($this -> getPageNo() > 1)
		{
			return $this -> getPageNo() - 1; 
		} elseif($bloop) {
			return $this -> getNumPages();
		} else {
			return $this -> getPageNo();
		}
	}

	public function getNextOffset($bloop = false)
	{
		return ($this -> getNextPage($bloop) - 1) * $this -> limit;
	}
	
	public function getPreviousOffset($bloop = false)
	{
		return ($this -> getPreviousPage($bloop) - 1) * $this -> limit;
	}
	
	public function getLastOffset()
	{
		return ($this -> getNumPages() - 1) * $this -> limit;
	}
	
	public function setData($adata = array())
	{
		$this -> _adata = $adata;
	}
	
	public function getData()
	{
		return $this -> _adata;
	}
	
	public function toArray()
	{
		return array(
			'data'    			=> $this -> _adata,
			'count'   			=> $this -> count,
			'offset'  			=> $this -> offset,
			'limit'   			=> $this -> limit,
			'rpp'    			=> $this -> limit,
			'pageno'  			=> $this -> getPageNo(),
			'numpages'   		=> $this -> getNumPages(),
			'nextpage'   		=> $this -> getNextPage(),
			'nextpagel'   		=> $this -> getNextPage(true),
			'previouspage'  	=> $this -> getPreviousPage(),
			'previouspagel' 	=> $this -> getPreviousPage(true),
			'nextoffset'   		=> $this -> getNextOffset(),
			'previousoffset'	=> $this -> getPreviousOffset(),
			'nextoffsetl'   	=> $this -> getNextOffset(true),
			'previousoffsetl' 	=> $this -> getPreviousOffset(true),
			'lastoffset'	  	=> $this -> getLastOffset(),
			'options'			=> $this -> options -> get(),
			'selcol'			=> $this -> selcol,
			'sort'				=> $this -> sort);
		
	}
	
}

class dwGrid extends dwGrid_object {
	private static $countoccurence = 0;	

	protected $_afields 		= array();
	protected $_scallbackfunc 	= null;
	protected $_currentview		= null;
	public $data		  = null;
	public $id			  = '';
	public $title		  = null;
	public $options	      = null;
	public $requester 	  = null;
	public $onNewField    = null;
	public $onFilter      = null;
	public $printFunction = null;
	public $cacheRequest  = array();
	
	public function __construct($mdb, $aoptions, $stitle, $id = null)
	{
		$this -> title		 = $stitle;
		$this -> id			 = is_null($id)?'dwGrid_'.++self::$countoccurence:$id;
		$this -> requester   = new dwGrid_requester($mdb);
		$this -> options 	 = new dwGrid_options($aoptions);
	}
	
	public function setCacheRequest($acacheRequest)
	{
		$this -> cacheRequest = array();
		$this -> addCacheRequest($acacheRequest);
	}
	
	public function addCacheRequest($mcacheRequest, $mvalue = null)
	{
		if(is_assoc($mcacheRequest))
		{
			foreach(array_keys($mcacheRequest) as $key)
			{
				$this -> cacheRequest[$key] = $mcacheRequest[$key];
			}				
		} else {
			$this -> cacheRequest[$mcacheRequest] = $mvalue;
		}	
	}
	
	public function getCacheRequest()
	{
		return $this -> cacheRequest;
	}

	public function getCacheRequestURL()
	{
		$aURL 	  = array();
		$aRequest = $this -> getCacheRequest();
		foreach(array_keys($aRequest) as $param)
		{
			$aURL[] = $param."=".$aRequest[$param];
		}
		return implode("&", $aURL);
	}
	
	public function &getFields()
	{
		return $this -> _afields;
	}
	
	public function getCurrentView()
	{
		return $this -> _currentView;
	}
	
	public function setData($adata)
	{
		$this -> data = $adata;
	}
	
	public function getData($data)
	{
		return $this -> data;
	}
	
	public function clearFields()
	{
		$this -> _afields = array();
	}

	public function getField($sname, $bstrict = false)
  	{
  		if(!isset($this -> _afields[$sname]))
  		{
  			if($bstrict)
  			{
  				throw new exception(E_GRID_FIELD_DONT_EXIST);
  			} else {
  				return null;
  			}
  		}
  		return $this -> _afields[$sname];
  	}
  	
  	public function setTitle($stitle)
  	{
  		$this -> title = $stitle;
  	}
  	
  	public function getTitle()
  	{
  		return $this -> title;
  	}
  	
  	public function &getFieldByCol($icol)
  	{
  		$keys = array_keys($this -> _afields);
  		if(isset($keys[$icol - 1]))
  		{
  			return $this -> getField($keys[$icol - 1]);
  		} else {
  			throw new exception(E_GRID_COL_ERROR);	
  		}
  	}
  	  	
  	public function setCallBackFunc($scallbackfunc)
  	{
  		$this -> _scallbackfunc	= $scallbackfunc;
  	}
  	
  	public function getCallBackFunc()
  	{
  		return $this -> _scallbackfunc;
  	}
  	
  	public function addFields($afields)
  	{
  		foreach(array_keys($afields) as $name)
  		{
  			if(is_array($afields[$name]))
  			{
  				$this -> addField($name, $name, $afields[$name]);
  			} else {
  				$this -> addField($name, $afields[$name]);
  			}
  		}
  	}
  	
  	public function &addField($sname, $scaption, $aproperties = array())
  	{
  		if(isset($this -> _fields[$sname]))
  		{
  			throw new exception(E_GRID_FIELD_EXIST);
  		}
  		$field = new dwGrid_field($sname, $scaption, $aproperties);
  		$this -> _raiseOnNewField($field);
  		$this -> _afields[$sname] = $field;
  		return $field; 
  	}
  	
  	private function _raiseOnNewField(&$ofield)
  	{
  		if(!is_null($this -> onNewField)
  		&& function_exists($this -> onNewField))
  		{
  			$f = $this -> onNewField;
  			$f($ofield);
  		}
  	}
 
	private function _raiseOnFilter($ofield, &$mvalue)
	{
		if(!is_null($this -> onFilter)
  		&& function_exists($this -> onFilter))
  		{
  			$f = $this -> onFilter;
  			$f($ofield, $mvalue);
  		}
	}
 
 	public function setFieldsFromRequest()
 	{
 		$bQuery = is_null($this -> data);
 		$adata  = $this -> data;
	 	if($bQuery)
		{
 			$ods = $this -> requester -> query(1, 0);
 			$rs = $ods -> fetchAssoc();
 			$afields = array_keys($rs);
 			$aInfo = $this -> requester -> odb -> getColumnsInfo($afields);
 			foreach($afields as $var)
 			{
 				$ofield = $this -> addField($var, $var);
 				if(isset($aInfo[$var]))
 				{
 					$ofield -> type = $aInfo[$var]['dwType'];
 				}
 			}
		} else {
			if(!empty($adata[0]))
			{
 				$afields = array_keys($adata[0]);
 				foreach($afields as $var)
	 			{
	 				$ofield = $this -> addField($var, $var);
	 				/** @TODO Gérer le typage dynamique */
	 				//$ofield -> type = ...;
	 			}
			}
		}
 		
 	}
 
 	public function prepare()
 	{
 		$bQuery = is_null($this -> data);
 		$adata  = $this -> data;
 		$ary = array();
 		$this -> _currentView = new dwGrid_view();
 		if(empty($this -> _afields))
 		{
			$this -> setFieldsFromRequest();
 		}
 		
 		if(request::get('dwGridId') == $this -> id)
 		{
 			$this -> _prepare();
 		}
 		
 		if($bQuery)
 		{
	 		$req = new dwGrid_requester($this -> requester -> odb);
	 		$req -> selectAdd('COUNT(*) as countRowDBGrid');
			$req -> set(array(
					"clauseWhere" => $this -> requester -> clauseWhere,
					"clauseFrom"  => $this -> requester -> clauseFrom)
			);
			$ods = $req -> query(0, 1);
	 		if($ods -> fetch())
	 		{
	 			$this -> _currentView -> count = (int)$ods -> f('countRowDBGrid');
	 		}
 		} else {
 			$this -> _currentView -> count = count($adata);
 		}
 		
 		if(request::get('dwGridId') == $this -> id)
 		{
 			$this -> _currentView -> limit   = request::get('l', $this -> options -> getRowsPerPage(), 'abs');
 			$this -> _currentView -> offset  = min(request::get('o', 0, 'abs'), $this -> _currentView -> getLastOffset());
 			$this -> _currentView -> selcol  = request::get('col', '', 'trim');
 			$this -> _currentView -> sort 	 = !empty($_REQUEST['s'])?$_REQUEST['s']:'ASC';
 		} else {
 			$this -> _currentView -> limit   = $this -> options -> getRowsPerPage();
 			$this -> _currentView -> offset  = 0;
 			$this -> _currentView -> selcol  = '';
 			$this -> _currentView -> sort 	 = '';
 		}

 		if(!empty($this -> _currentView -> selcol))
 		{
 			if($bQuery)
 			{
	    		$this -> requester -> sortAdd("ORDER BY ? ?", array($this -> _currentView -> selcol, $this -> _currentView -> sort));
 			} else {
 				/** @TODO Gérer le tri du tableau */
	 			//...
 			}
 		}
 		if($bQuery)
 		{
	 		$ods = $this -> requester -> query($this -> _currentView -> offset, $this -> _currentView -> limit);
	 		while($rs = $ods -> fetchAssoc())
	 		{
	 			$ary[] = $rs;
	 		}
 		} else {
 			$ary = array_values($adata);
 		}

 		
 		if(!is_null($this -> getActiveFieldsList()))
 		{
 			foreach($this -> _afields as &$field)
 			{
 				$field -> visible = in_array($field -> name, $this -> getActiveFieldsList());
 			}
 		}
 		$this -> _currentView -> setData($ary);
 	}
 
 	public function getActiveFieldsList()
 	{
 		return request::get($this -> id.'_fields');
 	}
 
  	public function setActiveFieldsList($afields)
 	{
 		return request::set($this -> id.'_fields', $afields);
 	}
 
 	public function toArray()
 	{
 	 	foreach($this -> _afields as $field)
 		{
 			$aFields[$field -> name] = $field -> get();
 		}
 		return array(
 			"active"   			=> $this -> isActive(),
 			"id"	   			=> $this -> id,
			"fields"   			=> $aFields, 
			"title"				=> $this -> title,
			"options"  			=> $this -> options -> get(),
			"view"	   			=> $this -> _currentView -> toArray(),
			"printFunction"		=> $this -> printFunction,
			"cacheRequest"		=> $this -> getCacheRequest(),
			"cacheRequestURL"	=> $this -> getCacheRequestURL(),
			"datagrid"			=> is_null($this -> data),
			"dwGrid"			=> $this
			);
 	}
 
 	public function isActive()
 	{
 		return request::get('dwGridId') == $this -> id;	
 	}
 
    private function _prepare()
  	{
  		if(!is_null($this -> data)) return;
  		$astr 	 = array();
  		$aparams = array();
		if($this -> options -> filter) 
	    {
	    	foreach($this -> _afields as $field) 
	      	{
		        if($field -> visible && $field -> filtered && !empty($_REQUEST[$field -> name]))
		        {
		        	$aparams[] = $field -> name;
		        	$value = $_REQUEST[$field -> name];
		        	$this -> _raiseOnFilter($field, $value);
		        	if(!empty($value))
		        	{
			        	$aparams[] = $value;
			        	if(isset($_REQUEST[$field -> name.'_end']))
			        	{
			        		$value2 = $_REQUEST[$field -> name.'_end'];
			        		$this -> _raiseOnFilter($field, $value2);
			        		if(!empty($value2))
			        		{
			        			$aparams[] = $value2;
			        		} 	
			        	}       	
			        	switch($field -> type)
			        	{
			        		case DW_FIELD_TYPE_NUMERIC: 
						        	if(!empty($value2))
						        	{
						        		$astr[] = "? BETWEEN ? AND ?";
						        	} else { 
			        					$astr[] = "? >= ?";
						        	}
			        				break;
			        		case DW_FIELD_TYPE_DATETIME:
			        		case DW_FIELD_TYPE_DATE:
			        				if(!empty($value2))
						        	{
						        		$astr[] = "? BETWEEN '?' AND '?'";
						        	} else { 
			        					$astr[] = "? LIKE '?%".($field -> type == DW_FIELD_TYPE_DATE?'_':'')."'";
						        	}
			        				break;
			        		default:
			        				if(!empty($value2))
						        	{
						        		$astr[] = "? BETWEEN '?' AND '?'";
						        	} else { 
			        					$astr[] = "UPPER(?) LIKE UPPER('?%')";
						        	}
			        				break;
			        	}
		        	}
		        }
	      	}
	    }
		$this -> requester -> whereAdd(implode(' AND ', $astr), $aparams);
  }
	
	
}
?>
