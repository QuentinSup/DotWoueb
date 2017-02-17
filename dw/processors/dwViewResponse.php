<?php

namespace dw\views;

use dw\classes\dwTemplate;
use dw\classes\dwViewInterface;

/**
 * Classe de base pour implementer l'association Model/View.
 * Cette classe est retourne par l'action au controleur.
 * Le controleur recupere le model et la vue pour les afficher.
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */
class dwTemplateView implements dwViewInterface
{
	protected $_otraducer = null;
	protected $_amodel = null;
	protected $_sview = null;

	public static function getCallerName() {
		return "view";
	}
	
	/**
	 * Constructeur de la classe
	 * @param string $stemplate le nom du template
	 */

	public function __construct($stemplate = null) 
	{
		$this -> setView($stemplate);
	}	
	
	/**
	 * Retourne le modele(tableau associatif)
	 * @return le tableau associatif (nom => valeur)
	 */
	public function &getModel()
	{
		return $this->_amodel;
	}
	
	/**
	 * Defini le tableau de modele
	 * @param $amodel le tableau de modele  
	 */
	public function setModel(&$amodel)
	{
		$this->_amodel = &$amodel;	
	}
	
	/**
	 * Ajoute une valeur au tableau de modele
	 * @param string $skey le nom de la donnee 
	 * @param string $mvalue la valeur
	 */
	public function addToModel($akeys, $mvalue = null, $stemplate = null)
	{
		if(is_array($akeys))
		{
			$mvalue = $akeys;
		}
		if(!is_null($stemplate))
		{
			
			$mvalue = dwTemplate::factory($stemplate, $mvalue);
		}
		if(is_array($akeys))
		{
			if($this->_amodel == null)
			{
				/** Do not enum values */
				$this->_amodel = $akeys;
			} else {
				/** enum values to add */
				foreach(array_keys($akeys) as $skey)
				{
					$this->_amodel[$skey]=$akeys[$skey];	
				}
			}
		} else {
			$this->_amodel[$akeys]=$mvalue;
		}
	}
	
	/**
	 * Defini le nom de la vue (nom du fichier template)
	 * @param le nom du fichier template
	 */
	public function setView($sview)
	{
		$this->_sview = $sview;
	}
	
	/**
	 * Retourne la vue (le nom du fichier template) 
	 * @return string le nom du fichier template
	 */
	public function getView()
	{
		return $this->_sview;
	}
	
	protected function _prepare()
	{
		$tpl = new dwTemplate();
		$tpl->assign($this -> _amodel);	
		return $tpl;
	}
	
	public function render($model)
	{
		if($model) {
			$this -> addToModel($model);
		}
		$tpl = $this -> _prepare();
		return $tpl->render($this -> _sview);
	}
	
	public function setTraducer(dwTraducer $otraducer)
	{
		$this -> _otraducer = $otraducer;
	}
	
	public function getTraducer()
	{
		return $this -> _otraducer;
	}
	
	public function hasTraducer()
	{
		return !is_null($this -> getTraducer());
	}
	
	public function traduce($skey, $sdefaultValue = null)
	{
		if(!is_null($this -> _otraducer))
		{
			return $this -> _otraducer -> get($skey, $sdefaultValue);
		}
		return $skey;
	}
	
	public function t($skey, $sdefaultValue = null)
	{
		return $this -> traduce($skey, (is_null($sdefaultValue)?$skey:$sdefaultValue));
	}
	
}
?>
