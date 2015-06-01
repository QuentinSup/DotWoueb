<?php

namespace dw\connectors\ldap;

/**
 * Classe LDAP
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

class dwLdapConnection {
	
	protected $_sdn = '';
	protected $_spasswd = '';
	protected $_sserver = '';
	protected $_iport = 389;
	protected $_rldap = null;
	protected $_rentries = null;
	protected $_currententry = null;
	
	/**
	 * Constructeur
	 * @param string $sserver Le serveur LDAP ou le controlleur de domaine pour ActiveDirectory
	 * @param int $iport le port  
	 */
	function __construct($sserver, $iport = 389)
	{
		$this -> _sserver	= $sserver;
		$this -> _iport		= $iport;
	}
	
	/**
	 * Se connecter au serveur LDAP
	 * @param string $slogin le login (pour active directory login@domaincomplet)
	 * @param string $spasswd le mot de passe
	 * @return false si la connexion echoue (utilisateur non valide en ActiveDirectory) ou true sinon
	 */
	function connect($slogin, $spasswd)
	{
		$this -> _sdn  		= $slogin;
		$this -> _spasswd 	= $spasswd;
		$this -> _rldap = ldap_connect($this -> _sserver, $this -> _iport);
		if($this -> _rldap)
		{
			ldap_set_option($this -> _rldap, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($this -> _rldap, LDAP_OPT_REFERRALS, 0);
			if(ldap_bind($this -> _rldap, $this -> _sdn, $this -> _spasswd))
			{
				return true;
			}
		}
		$this -> _rldap = null;
		return false;
	}
	
	function freeresult()
	{
		if(!is_null($this -> _rentries))
		{
			ldap_free_result($this -> _rentries);
			$this -> _rentries = null;
			$this -> _currententry = null;
		}	
	}
	
	function search($sdsn, $sfilter, $aattrsonly = array())
	{
		$this -> freeresult();		
		if(!is_null($this -> _rldap))
		{
			$this -> _rentries = ldap_search($this -> _rldap, $sdsn, $sfilter, $aattrsonly);
			if($this -> _rentries)
			{
				$this -> _currententry = ldap_first_entry($this -> _rldap, $this -> _rentries);
				return ldap_count_entries($this -> _rldap, $this -> _rentries);	
			} else {
				$this -> _rentries = null;
			}
		}
		return 0;
	}
	
	function toArray()
	{
		if(!is_null($this -> _rentries))
		{
			$ary = ldap_get_entries($this -> _rldap, $this -> _rentries);
			return $ary;	
		} else {
			return array();
		}
	}
	
	function fetch()
	{
		if(!is_null($this -> _currententry))
		{
			$aattributes = ldap_get_attributes($this -> _rldap, $this -> _currententry);
			$this -> _currententry = ldap_next_entry($this -> _rldap, $this -> _currententry);
			if(!$this -> _currententry)
			{
				$this -> freeresult();
			}
			return $aattributes;
		}
		return null;
	}
}

?>