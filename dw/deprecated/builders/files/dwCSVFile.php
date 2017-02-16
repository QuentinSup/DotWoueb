<?php

/**
 * dwCSV
 * Permet d'exporter un tableau de donn�es au format CSV
 * Le format CSV est visualisable avec Excel
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

class dwCsvFile_column
{
	public $index = '';
	public $name  = '';
}

class dwCsvFile
{
	private $_aCols = array();
	private $_aData  = array();
	public static $separator = ';';
		
	/**
	 * @name addCol
	 * Ajout d une colonne au document
	 * @param string $sColumnIndex Index de la colonne
	 * @param string $sColumnName Libelle de la colonne
	 */
	public function addCol($sColumnIndex, $sColumnName)
	{
		$aCol = &$this -> _aCols[];
		$aCol = new dwCsvFile_column();
		$aCol -> index= $sColumnIndex;
		$aCol -> name = $sColumnName;
	}

	/**
	 * @name getCols
	 * Recupere la liste des colonnes
	 */
	public function getCols()
	{
		return $this -> _aCols;
	}

	/**
	 * @name clear
	 * Supprime la liste des colonnes et des donn�es du document
	 */
	public function clear()
	{
		$this -> _aCols = array();
		$this -> _aData = array();
	}

	/**
	 * @name fetchRow
	 * Ajout d'une ligne de donn�es au tableau
	 * @param array $aData Tableau de donn�es ("index de colonne" => "valeur")
	 */
	public function fetchRow($aData)
	{
		$aRow = &$this -> _aData[];
		foreach($this -> _aCols as $oCol)
		{
			if(isset($aData[$oCol -> index]))
			{
				$aRow[$oCol -> index] = $aData[$oCol -> index];
			}	
		}
	}
	
	/**
	 * @name toArray
	 * Renvoi le tableau de donn�es
	 */
	public function toArray()
	{
		return $this -> _aData;	
	}
	
	/**
	 * @name toCSV
	 * Export les donn�es vers un fichier au format CSV
	 * @param string $sfilename nom du fichier
	 * @param array $aBlackList Liste d'index de colonnes � ignorer
	 * @param string $sFuncDisplay Function d appel personnalis�e pour le formattage des donn�es
	 */
	public function toCSV($sfilename)
	{
		return self::arraytoCSV($this -> _aCols, $this -> _aData, $sfilename);
	}
	
	public function display()
	{
		return self::arraytoPrint($this -> _aCols, $this -> _aData);	
	}
	
	public function arraytoPrint($aCols, $aTab, $contentType = "application/x-msexcel")
	{
		$scontent = self::toString($aCols, $aTab);
		header("Content-Type: ".$contentType);
		echo $scontent;	
	}
	
	public function toString()
	{
		return self::arraytoString($this -> _aCols, $this -> _aData);	
	}

	public static function arraytoCSV($aCols, $aTab, $sfilename)
	{
		$scontent = self::arraytoString($aCols, $aTab);
		return file_put_contents($sfilename, $scontent);
	}
	
	public static function arraytoString($aCols, $aTab)
	{
		$aSource = array();
		foreach($aCols as $col)
		{
			$aColumns[] = $col -> name;
		}
		$aSource[] = implode(self::$separator, $aColumns);
		foreach($aTab as $aRow)
		{
			$aSource[] = implode(self::$separator, $aRow);
		}
    	return implode("\n", $aSource);
	}
}
?>