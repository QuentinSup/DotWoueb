<?php

namespace dw\classes;

use dw\helpers\dwFile;

class dwSimpleXMLElement extends dwObject
{
	public $cdata = "";
}

class dwSimpleXML {
	
	private $acurrent;
	private $level = 0;
	private $adata = null;
	private $acurData = null;
	protected $_oroot = null;
	
	// Logger
	private static function logger() {
		static $logger = null;
		if(is_null($logger)) {
			$logger = dwLogger::getLogger(__CLASS__);
		}
		return $logger;
	}
	
	/**
	 * The constructor
	 * If param $sxml is set, parse the file with the encoding specified
	 * @param $sxml The Xml content (optional)
	 * @param $sencoding The encoding of the file (optional, DW_DEFAULT_ENCODING by default)
	 */
	function __construct($sxml = null, $sencoding = DW_DEFAULT_ENCODING)
	{
		if(!is_null($sxml))
		{
			$this -> parseXML($sxml, $sencoding);
		}
	}
	
	/**
	 * Parse an xml file
	 * @param $sxml The Xml file path
	 * @param $sencoding The encoding of the file (optional, DW_DEFAULT_ENCODING by default)
	 */
	public function parse($sfile, $sencoding = DW_DEFAULT_ENCODING)
	{
		if(self::logger() -> isTraceEnabled()) {
			self::logger() -> trace("parse XML file '$sfile' with encoding '$sencoding'");	
		}
		
		return $this -> parseXML(dwFile::getContents($sfile), $sencoding);
	}
	
	/**
	 * Parse an xml file
	 * @param $sxml The Xml content
	 * @param $sencoding The encoding of the file (optional, DW_DEFAULT_ENCODING by default)
	 */
    public function parseXML($sxml, $sencoding = DW_DEFAULT_ENCODING)
    {

    	$oXMLParser = xml_parser_create($sencoding);

        xml_set_object($oXMLParser, $this);
        xml_set_element_handler($oXMLParser, "tag_open", "tag_close");
        xml_set_character_data_handler($oXMLParser, "cdata");
    	
    	$this -> adata = new dwSimpleXMLElement();
    	$this -> acurData = &$this -> adata;
    
        xml_parse($oXMLParser, $sxml);
        xml_parser_free($oXMLParser);
		
 		return $this -> adata;
 		
    }
    
	/**
	 * Return the root tag
	 */
    public function root()
    {
    	return $this -> _oroot;
    }
	
	/**
	 * parse open tag
	 */ 
    protected function tag_open($parser, $tag, $attributes)
    {
    	$this -> level++;
    	$this -> acurrent[$this -> level] = &$this -> acurData;
    	$stag = strtolower($tag);
    	if(isset($this -> acurData -> $stag))
    	{
    		if(is_object($this -> acurData -> $stag))
    		{
    			$this -> acurData -> $stag = array($this -> acurData -> $stag);
    		}
    		$a = &$this -> acurData -> $stag;
    		$this -> acurData = &$a[];
    	} else {
    		$this -> acurData = &$this -> acurData -> $stag;
    	}
   		$this -> acurData = new dwSimpleXMLElement(array_change_key_case($attributes));
    }
	
	/**
	 * parse CDATA
	 */
    protected function cdata($parser, $cdata)
    {
    	if(trim($cdata))
    	{
       		@$this -> acurData -> cdata .= $cdata;
    	}
    }
	
	/**
	 * parse close tag
	 */
    protected function tag_close($parser, $tag)
    {
    	$this -> acurData = &$this -> acurrent[$this -> level];
    	$this -> level--;
    	if($this -> level == 0)
    	{
    		$stag = strtolower($tag);
    		$this -> _oroot = $this -> acurData -> $stag;
    	}
    }

}

?>