<?php

namespace dw\helpers;

class dwFile {
	
	/**
	 * getAbsoluteName()
	 * Retourne le nom du fichier sans l'extension
	 * @return string
	 * @param string $sfilename Chemin ou nom de fichier
	 */
	public static function getAbsoluteName($sfilename)
	{
	    $file = basename($sfilename);
	    $file = strtok($file, ".");
	    return $file;
	}
	
	/**
	 * getExtension()
	 * Retourne l'extension du fichier
	 * @return string
	 * @param string $sfilename Chemin ou nom de fichier
	 */
	public static function getExtension($sfilename)
	{
		return pathinfo($sfilename, PATHINFO_EXTENSION);
	}

	/**
	 * Retourne si le fichier existe
	 * @return boolean
	 * @param string $sfile Chemin ou nom de fichier
	 */
	public static function exist($sfile)
	{
		return file_exists($sfile);
	}

	/**
	 * MD5()
	 * Retourne la valeur du contenu de fichier crypt頡vec la m鴨ode de hashage MD5 (irr鶥rsible)
	 * @return stringMD5
	 * @param string $sfilename Chemin ou nom de fichier
	 */
	public static function MD5($sfilename)
	{
		return md5_file($sfilename);
	}

	/**
	 * getContents()
	 * Retourne le contenu du fichier (alias de file_get_contents)
	 * @return string
	 * @param string $sfilename Chemin ou nom de fichier
	 */
	public static function getContents($sfilename)
	{
		return file_get_contents($sfilename);
	}
	
	public static function getBase64File($filename) {
		return base64_encode(self::getContents($filename));
	}
	
	/**
	 * cSize()
	 * Renvoi la plus haute valeur de la taille d'un fichier
	 * @return string
	 * @param int $isize Taille du fichier
	 * @param array $asizetypes tableau des valeurs de grandeurs
	 */
	function cSize($isize = null, $asizetypes = array('octets', 'Ko', 'Mo', 'Go', 'To'))
	{
		$type = 0;
		while($isize >= 1024)
		{
			$isize = $isize / 1024;
			$type++;
		}
		return round($isize, 2).' '.$asizetypes[$type];
	}
	
	public static function ls($sdir = './', $aexfiles = array(), $bincsubdir = false, $callbackfunc = null)
	{	
		/*$aexfiles[] = basename($_SERVER['PHP_SELF']);*/
		foreach($aexfiles as &$selt) { $selt = strtolower($selt); }
		$ary = array();
		
		/*
		 * Fonction parcourant les fichiers d un repertoire
		 * @param string $sdir repertoire
		 * @param array $ary tableau de valeurs
		 * @param array $aexfiles tableau de nom de fichiers a exclure du traitement
		 */
		
		
		#Lance le traitement;
		self::__list_dir($sdir, $ary, $aexfiles, $bincsubdir, $callbackfunc);

		return $ary;
		
	}
	
	private static function __list_dir($sdir, &$ary, $aexfiles, $bincsubdir = false, $callbackfunc = null)
	{
		if ($dh = opendir($sdir)) {
			# >> PARCOURT LE REPERTOIRE
		    while ($file = readdir($dh)) {
		       if($file != '.' && $file != '..' && !in_array(strtolower($file), $aexfiles))
		       {
			       if($bincsubdir && is_dir($sdir.'/'.$file))
			       {
			       		# -> ETEND LE TRAITEMENT AU SOUS-DOSSIER
			       		self::__list_dir($sdir.'/'.$file, $ary, $aexfiles, $bincsubdir, $callbackfunc);
			       } else 
			       {
			       		if(!is_null($callbackfunc))
			       		{
			       			$callbackfunc($sdir, $file);
			       		}
			           	$ary[] = $sdir.'/'.$file;
			       }
		       }
		      
			}
			closedir($dh);
		}	
	}
		
}
 
?>