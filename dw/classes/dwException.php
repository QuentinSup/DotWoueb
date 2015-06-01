<?php

namespace dw\classes;

/**
 * dwException
 * Gère un niveau supplémentaire de détail pour les exceptions
 * @author Quentin Supernant
 * @package dotWoueb
 */
 class dwException extends \exception
 {
	private $_susermessage = '';
	
	/**
	 * construct()
	 * Constructeur
	 * @param string $smsg Message initial de l'exception
	 * @param string $susermsg Message personnalis頤estin頠 l'utilisateur
	 */
	public function __construct($smsg, $susermsg = '')
	{
		parent::__construct($smsg);
		$this -> _susermessage = $susermsg;
	}

	/**
	 * getUserMessage()
	 * @return string Le message personnalis頰our les utilisateurs
	 */
	public function getUserMessage()
	{
		return $this -> _susermessage;
	}

	/**
	 * toArray()
	 * @param dwException $exception Objet exception
	 */
    public static function toArray($exception = null) 
    {
    	if(is_subclass_of($exception, __CLASS__))
		{
			$ary = array(
				'USERMESSAGE' 	=> $exception -> getUserMessage(),
				'MESSAGE'   	=> $exception -> getMessage(),
				'FILE'			=> $exception -> getFile(),
				'LINE'			=> $exception -> getLine(),
				'TRACE'			=> $exception -> getTraceAsString());
    	} else {
    		 $ary = array(
				'MESSAGE'   	=> $exception -> getMessage(),
				'FILE'			=> $exception -> getFile(),
				'LINE'			=> $exception -> getLine(),
				'TRACE'			=> $exception -> getTraceAsString());
    	}
    	return $ary;
    }
    
    /**
     * raise()
     * Affiche ࠬ'飲an les informations de l'exception
     */
    public static function raise($oexception)
    {
    	echo implode('<br />', self::toArray($oexception));
    }
        
 }
?>