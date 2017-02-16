<?php

/**
 * dwSylkFile
 * Permet d'exporter un tableau de données au format SYLK
 * Le format SYLK est visualisable avec Excel
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

class dwSylkFile_column
{
	public $name  = '';
	public $index = '';
	public $type  = DW_FIELD_TYPE_STRING;
}

class dwSylkFile
{
	private $_aCols = array();
	private $_aData  = array();
	public $title = '';
	
	/**
	 * Constructeur
	 * @param string $stitle Titre du document
	 */
	public function __construct($stitle = '')
	{
		$this -> title = $stitle;
	}
	
	/**
	 * @name addCol
	 * Ajout d une colonne au document
	 * @param string $sColumnIndex Index de la colonne
	 * @param string $sColumnName Libelle de la colonne
	 * @param string $iColumnType Type de données de la colonne
	 */
	public function addCol($sColumnIndex, $sColumnName, $iColumnType = fSYLK_FIELD_STRING)
	{
		$aCol = &$this -> _aCols[];
		$aCol = new dwSylkFile_column();
		$aCol -> index= $sColumnIndex;
		$aCol -> name = $sColumnName;
		$aCol -> type = $iColumnType;
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
	 * Supprime la liste des colonnes et des données du document
	 */
	public function clear()
	{
		$this -> _aCols = array();
		$this -> _aData = array();
	}

	/**
	 * @name fetchRow
	 * Ajout d'une ligne de données au tableau
	 * @param array $aData Tableau de données ("index de colonne" => "valeur")
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
	 * Renvoi le tableau de données
	 */
	public function toArray()
	{
		return $this -> _aData;	
	}
	
	/**
	 * @name toSYLK
	 * Export les données vers un fichier au format SYLK
	 * @param string $sfilename nom du fichier
	 * @param array $aBlackList Liste d'index de colonnes à ignorer
	 * @param string $sFuncDisplay Function d appel personnalisée pour le formattage des données
	 */
	public function toSYLK($sfilename, $aBlackList = array(), $sFuncDisplay = null)
	{
		return self::arraytoSYLK($this -> _aCols, $this -> _aData, $sfilename, $this -> title, $aBlackList, $sFuncDisplay);
	}
	
	public function display($aBlackList = array(), $sFuncDisplay = null)
	{
		return self::arraytoPrint($this -> _aCols, $this -> _aData, $this -> title, $aBlackList, $sFuncDisplay);	
	}
	
	public function arraytoPrint($aCols, $aTab, $stitle = '', $aBlackList = array(), $sFuncDisplay = null)
	{
		$scontent = self::toString($aCols, $aTab, $stitle, $aBlackList, $sFuncDisplay);
		header("Content-Type: application/x-msexcel");
		echo $scontent;	
	}
	
	public function toString($aBlackList = array(), $sFuncDisplay = null)
	{
		return self::arraytoString($this -> _aCols, $this -> _aData, $this -> title, $aBlackList, $sFuncDisplay);	
	}

	public static function arraytoSYLK($aCols, $aTab, $sfilename, $stitle = '', $aBlackList = array(), $sFuncDisplay = null)
	{
		$scontent = self::arraytoString($aCols, $aTab, $stitle, $aBlackList, $sFuncDisplay);
		return file_put_contents($sfilename, $scontent);
	}
	
	public static function arraytoString($aCols, $aTab, $stitle = '', $aBlackList = array(), $sFuncDisplay = null)
	{
		$aSource = array();
		$aSource[] = "ID;P".$stitle;
		$aSource[] = "B;Y".count($aCols).";X".count($aTab);
		$iCol = 0;
		foreach($aCols as $oCol)
		{
			if(!in_array($oCol -> index, $aBlackList))
			{
				$aSource[] = "C;Y1;X".++$iCol.";N;K".'"'.$oCol -> name.'"';
			}		
		}
		$istartLine = 2;
		foreach($aTab as $aRow)
		{
			$iCol = 0;
			foreach($aCols as $oCol)
			{
				if(!in_array($oCol -> index, $aBlackList))
				{
					$value = $aRow[$oCol -> index];
					if(!is_null($sFuncDisplay) && function_exists($sFuncDisplay))
					{
						$sFuncDisplay($value, $oCol);
					}
					switch($oCol -> type)
					{
						case DW_FIELD_TYPE_NUMERIC:	break;
						case DW_FIELD_TYPE_DATE	  :
						case DW_FIELD_TYPE_STRING :	$value = '"'.$value.'"'; break;
					}
					$aSource[] = "C;Y".$istartLine.";X".++$iCol.";N;K".$value;
				}		
			}
			$istartLine++;
		}
    	$aSource[] = "E";
    	return implode("\n", $aSource);
	}
}
?>