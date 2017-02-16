<?php

namespace dw\views;

use dw\classes\dwViewInterface;

abstract class dwDBEntityView implements dwViewInterface
{
	protected static $_sentity 		= null;
	protected static $_osap	   		= null;
	protected static $_dataObject	= null;
	
	public function prepareEntity($sentity, $avalues)
	{
		$agroupList = array(); $bedit = false;
		
		self::$_sentity = $sentity; 
		
		$osap = new dwSAP($sentity);
		$do = dw::DB() -> factory($sentity);
		self::$_dataObject = $do;
		if(count(array_intersect($do -> getPrimaryKeys(), array_keys($avalues))) == count($do -> getPrimaryKeys()))
		{
			$bedit = true;
			$do -> setKeysFrom($avalues);
			if(!$do -> find())
			{
				throw new exception("RecordNotFound");
			}
		}
		self::$_osap = $osap;
		$oform = dw::rForm() -> fetchFromEntity($do, (is_null($osap -> getForm())?"":$osap -> getForm() -> title), dwXmlTraducer::factory($sentity), (is_null($osap -> getForm())?array():$osap -> getForm() -> ignoreFields));
		if(!is_null($osap -> getForm()))
		{
			foreach($osap -> getForm() -> buttons as $button)
			{
				if(!$button -> isNull("rule"))
				{
					$sAttr = "can".ucfirst($button -> rule);
					if(!$osap -> getForm() -> $sAttr)
					{
						continue;
					}
					if(($button -> rule == "update" && !$bedit) || ($button -> rule == "insert" && $bedit))
					{
						continue;
					}
				}
				$agroupList[] = $button -> name;
				$oform -> addElement($button);
				if(!$button -> isNull("event"))
				{
					$oform -> setSubmitEvent($button -> name, get_class($this).'::'.$button -> event);
				}
			}
			foreach($osap -> getForm() -> fields as $field)
			{
				
			}
		}
		$oform -> addGroupList($agroupList);
		if(($bedit && (!is_null($osap -> getForm()) && (!$osap -> getForm() -> canUpdate) || $osap -> getForm() -> isReadOnly())))
		{
			$oform -> freeze();
		}
		return $oform;
	}
	
	public function prepareAndRenderEntity($sentity, $avalues)
	{
		dw::renderForm($this -> prepareEntity($sentity, $avalues));
	}
	
	public static function validate($form)
	{
		if($form -> isValid())
		{
			$do = dw::DB() -> factory(self::$_sentity, $_REQUEST);
			if($do -> keyExists())
			{
				if(self::$_osap -> getForm() -> canUpdate)
				{
					$do -> update();
					$form -> freeze();
				}
			} elseif(self::$_osap -> getForm() -> canInsert) {
				$do -> insert();
				$form -> freeze();
			}
		}
	}

	public static function delete($form)
	{
		if(self::$_osap -> canDelete)
		{
			$do = dw::DB() -> factory(self::$_sentity);
			$do -> setKeysFrom($_REQUEST);
			$do -> delete();
			$form -> freeze();
		}
	}
	
	public static function previsu($form)
	{
		if($form -> isValid())
		{
			//$form -> freeze();
		}
	}
	
} 

?>