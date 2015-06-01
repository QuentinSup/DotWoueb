<?php

define('DW_HTML_META_TYPE_HTTP', 1);
define('DW_HTML_META_TYPE_GENERAL', 0);

if(!defined('DW_STYLESHEETS_DIR'))	define("DW_STYLESHEETS_DIR", "./css/");
if(!defined('DW_JAVASCRIPT_DIR'))	define("DW_JAVASCRIPT_DIR", "./js/");

class dwHTMLModel_head_script extends dwHTMLTag
{
	public $type   	 = null;
	public $src  	 = null;
	public $language = null;
	public $code	 = null;
	
	public function __construct($aattributes)
	{
		parent::__construct($aattributes);
		$this -> dontExport("code");
	}
}

class dwHTMLModel_head_link extends dwHTMLTag
{
	public $rel   	 = null;
	public $href  	 = null;
	public $title 	 = null;
	public $media 	 = null;
	public $target	 = null;
	public $hreflang = null;
	public $charset	 = null;
	public $src		 = null;
}

class dwHTMLModel_head_meta extends dwHTMLTag
{
	public $type	= null;
	public $name    = null;
	public $content = null;
	public $lang	= null;
	public $charset = null;
	public $base	= null;
}

class dwHTMLModel_head extends dwHTMLTag
{
	public $dir			= null; #LTR ou RTL
	public $lang        = null; #FR, EN, ...
	public $profile		= null;
	public $links       = array();
	public $metas       = array();
	public $scripts		= array();
	public $title       = null;
	
	public function __construct($stitle = null)
	{
		parent::__construct();
		$this -> title = $stitle;
		$this -> dontExport("title");
	}
	
	public function setMeta($sname, $scontent, $slang = null, $scharset = null, $itype = DW_HTML_META_TYPE_GENERAL)
	{
		unset($this -> metas[$sname]);
		$this -> metas[$sname] = new dwHTMLModel_head_meta(
					array(
						"type"    => $itype, 
						"name"    => $sname, 
						"content" => $scontent, 
						"lang"	  => $slang, 
						"charset" => $scharset));
		return $this -> metas[$sname];
	}

	public function setHTTPMeta($shttpequiv, $scontent, $slang = null, $scharset = null)
	{
		return $this -> setMeta($shttpequiv, $scontent, $slang, $scharset, DW_HTML_META_TYPE_HTTP);
	}
	
	public function addLink($srel, $shref, $stitle = null, $smedia = null, $aattributes = array())
	{
		$link = &$this -> links[];
		$link = new dwHTMLModel_head_link($aattributes);
		$link -> setAttributes(array(
							"rel"  => $srel,
							"href" => $shref,
							"title"=> $stitle,
							"media"=> $smedia
						));
		return $link;
	}
	
	public function linkScript($stype, $ssrc)
	{
		$script = &$this -> scripts[];
		$script = new dwHTMLModel_head_script(array(
						"type" => $stype,
						"src"  => $ssrc
					));
		return $script;
	}
	
	public function linkStyleSheet($mstylesheet, $sdir)
	{
		if(is_array($mstylesheet))
		{
			foreach($mstylesheet as $stylesheet)
			{
				$this -> addLink("stylesheet", $sdir.$stylesheet);	
			}
		} else {
			$this -> addLink("stylesheet", $sdir.$mstylesheet);
		}
	}
	
	public function implementScript($scode, $slanguage = null)
	{
		$script = &$this -> linkScript(null, null);
		$script -> setAttributes(array(
						"code" => $scode,
						"language" => $slanguage
					));
		return $script;
	}
	
}

class dwHTMLModel_body extends dwHTMLTag
{
	public $onload 		= null;
	public $onunload 	= null;
	private $_abody 	= array();

	public function __construct()
	{
		parent::__construct();
		$this -> dontExport("_abody");
	}

	public function addHTML($shtml)
	{
		$this -> _abody[] = $shtml;
	}
	
	public function getContent()
	{
		return $this -> _abody;
	}
	
	public function clear()
	{
		$this -> _abody = array();
	}
	
}

class dwHTMLBuilder
{
	public $docType     = null;
 	public $htmlHead	= null;
 	public $htmlBody    = null;
 	
 	private static $_currentModel = null;
	
	public function __construct($stitle = null)
	{
		self::$_currentModel = $this;
		$this -> htmlHead = new dwHTMLModel_head($stitle);
		$this -> htmlBody = new dwHTMLModel_body();
	}

	public function clearBody()
	{
		unset($this -> htmlBody);
		$this -> htmlBody = dwHTMLModel_body();
	}
	
	public static function getCurrentModel()
	{
		return self::$_currentModel;
	}
	
	public function linkStyleSheet($mstylesheet, $sdir = DW_STYLESHEETS_DIR)
	{
		$this -> htmlHead -> linkStyleSheet($mstylesheet, $sdir);
	}
	
	public function linkJScript($mjscript, $sdir = DW_JAVASCRIPT_DIR)
	{
		$this -> htmlHead -> linkScript('text/javascript', $sdir.$mjscript);
	}
	
	public function addToBody($shtmlcontent)
	{
		$this -> htmlBody -> addHTML($shtmlcontent);
	}
		
	public function addTemplateToBody($stemplate, $avalues = array(), $sdir = null)
	{
		$tpl = dwTemplate::factory($avalues, $stemplate.'.tpl', $sdir);
		$this -> addToBody($tpl);
	}
	
	public function toArray()
	{
		return array(
			"html" => array("doctype" => $this -> docType),
			"head" => $this -> htmlHead -> toArray('attributes'),
			"body" => $this -> htmlBody -> toArray('attributes'),
			"bodyContent" => $this -> htmlBody -> getContent()
		);
	}

}

?>