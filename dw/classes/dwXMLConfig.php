<?php

namespace dw\classes;

use dw\classes\dwSimpleXML;

class dwXMLConfig
{
	protected $_author  = '';
	protected $_version = '';
	protected $_name	 = '';
	protected $_description = '';
	protected $_vars		 = '';
	
	public function getVar($svar) 	{ return (isset($this -> _vars[strtoupper($svar)])?$this -> _vars[strtoupper($svar)]:null); }
	public function setVar($svar, $mvalue)	{ $this -> _vars[strtoupper($svar)] = $mvalue; }
	public function getName() 		{ return $this -> _name; }
	public function getDescription(){ return $this -> _description; }
	public function getAuthor()		{ return $this -> _author; }
	public function getVersion()	{ return $this -> _version; }
	
	// Logger
	private static function logger() {
		static $logger = null;
		if(is_null($logger)) {
			$logger = dwLogger::getLogger(__CLASS__);
		}
		return $logger;
	}
	
	/**
	 * Load app configuration
	 * @param $curPath path
	 * @param $xXml Xml file name
	 * @param $sencoding Encoding (optional, DW_DEFAULT_ENCODING by default)
	 */
	public function loadConfig($curPath = './', $sXml = 'config.xml', $sencoding = DW_DEFAULT_ENCODING) 
	{
		if(self::logger() -> isTraceEnabled()) {
			self::logger() -> trace("Load app configuration from $curPath$sXml with encoding '$sencoding'");
		}

		$oxml = new dwSimpleXML();
		
		if(!$oxml -> parse($curPath.$sXml, $sencoding) || !$oxml -> root()) 
		{
			if(self::logger() -> isDebugEnabled()) {
				self::logger() -> debug("Wrong parse from $curPath$sXml with encoding '$sencoding'");
			}
			
			return false;
		}
		
		$oroot = $oxml -> root();
		
		if($oroot -> about)
		{
			$this -> _name		   = (string)$oroot -> about -> name -> cdata;
			$this -> _description  = (string)$oroot -> about -> description -> cdata;
			$this -> _author 	   = (string)$oroot -> about -> author -> cdata;
			$this -> _version 	   = (string)$oroot -> about -> version -> cdata;
		}
		
		
		
		if($oroot -> config)
		{
			$this -> setXMLConfig($oroot -> config);
		}
		return $oroot;
	}

	private function __setXMLConfigVars($var)
	{
		if(isset($var -> name))
		{
			$name = strtoupper($var -> name);
			$value = "";
			if(isset($var -> cdata))
			{
				$value = $var -> cdata;
			} elseif(isset($var -> value)) {					
				$value = $var -> value;	
			}		
			$this -> _vars[$name] = $value;
			if(isset($var -> defined) && (int)$var -> defined == 1)
			{		
				if(!defined($name))
				{
					define($name, $value);
				}
			}
		}
	}
	
	public function setXMLConfig($config)
	{
		$svar = 'var';
		if($config -> $svar)
		{
			if(is_seq($config -> $svar))
			{
				foreach($config -> $svar as $var)
				{
					$this -> __setXMLConfigVars($var);
				}
			} else {
				$this -> __setXMLConfigVars($config -> $svar);
			}
		}
	}
	
	/**
	 * Return attributes from an XmlConfig object
	 */
	public static function getAttributes($xmlConfig)
	{
		return array(
			"name" => $xmlConfig -> _name, 
			"author" => $xmlConfig -> _author, 
			"version" => $xmlConfig -> _version,
			"description" => $xmlConfig -> _description,
			"vars"		  => $xmlConfig -> _vars);	
	}

	public function __get($svar)
	{
		return $this -> getVar($svar);
	}
	
	public function getVars()
	{
		return $this -> _vars;
	}

	/**
	 * Return array of attributes
	 */
	public function toArray()
	{
		return self::getAttributes($this);	
	}
	
	
}

?>