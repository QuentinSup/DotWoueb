<?php

/**
 * Gestionnaire de rendu
 * @author Quentin Supernant
 */

class dwBuildManager
{
	/**
	 * @var Array Tableau d'objets utilisés pour our le rendu
	 */
	private static $_arenderer = array();

	/**
	 * Peut être utilisé en tant que fonction ou mode (ou les deux)
	 * @param String sHTML Parametre optionnel : code HTML a rajouter ࠬa page courante
	 * @example dw::HTML() Renvoi l'objet de rendu HTML
	 * @example dw::HTML("<div>Bonjour</div>") Ajoute une balise DIV avec le texte "Bonjour" au code HTML de la page courante
	 */
	public static function HTML($sHTML = null)
	{
		if(!is_null($sHTML))
		{
			self::HTML() -> addToBody($sHTML);
		}
		return dwHTMLModel::getCurrentModel();
	}

	/**
	 * Retourne l'objet rendu selon le type passé en paramètee
	 * @param String sType Peut avoir comme valeur : HTML, FORM, GRID
	 * @example getRenderer("HTML") Renvoi l'objet s'occupant du rendu HTML
	 */
	public static function getRenderer($sType)
	{
		$sType = strtoupper($sType);
		return (isset(self::$_arenderer[$sType])?self::$_arenderer[$sType]:null);
	}
	
	
	public static function getHTMLRenderer()
	{
		return self::getRenderer("HTML");
	}
	
	public static function rHTML()
	{
		return self::getHTMLRenderer();
	}
	
	public static function getFormRenderer()
	{
		return self::getRenderer("FORM");
	}

	public static function rForm()
	{
		return self::getFormRenderer();
	}
	
	public static function getGridRenderer()
	{
		return self::getRenderer("GRID");
	}

	public static function rGrid()
	{
		return self::getGridRenderer();
	}
	
	public static function renderForm($form)
	{
		self::getFormRenderer() -> render($form);
	}

	public static function renderGrid($grid)
	{
		self::getGridRenderer() -> render($grid);
	}

	public static function setRenderer($stype, $orenderer)
	{
		self::$_arenderer[strtoupper($stype)] = $orenderer;
	}

	public static function setHTMLRenderer($orenderer)
	{
		self::setRenderer("HTML", $orenderer);
	}

	public static function setFormRenderer($orenderer)
	{
		self::setRenderer("FORM", $orenderer);
	}
	
	public static function setGridRenderer($orenderer)
	{
		self::setRenderer("GRID", $orenderer);
	}

	public static function newForm($sname, $stitle = null, $saction = null, $bsynchro = true)
	{
		if(self::$_useCacheForm && request::get(md5("cacheForm$sname")) == '1')
		{
			$oform = isset(self::$_cacheObject[$sname])?self::$_cacheObject[$sname]:null;
			if(is_object($oform))
			{
				if($bsynchro)
				{
					$oform -> synchronize();
				}
				return $oform;
			}
		}
		if(is_null($saction))
		{
			$saction = $_SERVER['REQUEST_URI'];
		}
		$oform = new dwFormBuilder($sname, $saction);
		if(!is_null($stitle))
		{
			$oform -> setTitle($stitle);
		}
		if(self::$_useCacheForm)
		{
			$oform -> addHidden(md5("cacheForm$sname"), 1);
			self::$_cacheObject[$sname] = $oform;
		}
		if($bsynchro)
		{
			$oform -> synchronize();
		}
		return $oform;
	}
	
	public static function newGrid($aoptions = array(), $id = null, $mdb = null)
	{
		if(is_null($mdb))
		{
			$mdb = dw::DB();
		}
		return new dwGridBuilder($mdb, $aoptions, $id);
	}
		
}

?>