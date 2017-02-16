<?php
include_ext('fpdf/fpdf');

/**
 * dwPDFGrid
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */

class dwPdfGrid_column
{
	public $slabel  = '';
	public $sindex  = '';
	public $iwidth  = 10;
	public $bmultiline = false;
	public $salignement = "";
	public function __construct($sindex, $slabel, $iwidth, $salignement = "", $bmultiline = false)
	{
		$this -> sindex = $sindex;
		$this -> slabel = $slabel;
		$this -> iwidth = $iwidth;
		$this -> salignement = $salignement;
		$this -> bmultiline  = $bmultiline;
	}
}

class dwPdfGrid extends FPDF
{	
	private $_acols = array();
	private $_ary   = array();
	private $_ihrow  = 5;
	private $_ihrowH = 6;
	private $_ibY = 0;
	private $_ilX = 0;
	private $_sborderCol = "BRL";
	private $_bupdate    = false;
	private $_sout	     = "";
	
	public function __construct($orientation = "P") {
	  parent::__construct($orientation);
	  $this -> AliasNbPages();
	  $this -> SetFont("Arial", "", 10);
	  $this -> SetDisplayMode(100);
	}
	
	public function clearCols()
	{
		$this -> _acols = array();	
	}
	
	public function clear()
	{
		$this -> _ary = array();
	}
	
	public function toArray()
	{
		return $this -> _ary;
	}

	public function setBorderCol($sborderCol = "BRL")
	{
		$this -> _sborderCol = $sborderCol;	
	}

	public function getBorderCol()
	{
		return $this -> _sborderCol;	
	}

	public function setRowHeight($ihrow = 5)
	{
		$this -> _ihrow = $ihrow;
	}
	
	public function getRowHeight()
	{
		return $this -> _ihrow;	
	}
	
	public function setRowHeightHeader($ihrow = 7)
	{
		$this -> _ihrowH = $ihrow;
	}
	
	public function getRowHeightHeader()
	{
		return $this -> _ihrowH;	
	}
	
	public function addCol($sindex, $slabel, $iwidth, $salignement = "C", $bmultiline = false)
	  {
	  	$this -> _acols[] = new dwPdfGrid_column($sindex, $slabel, $iwidth, $salignement, $bmultiline);
	}
	
	public function beginRow() {
		$this -> AutoPageBreak = false;
		$this -> BeginUpdate();
	}
	
	public function beginUpdate()
	{
		$this -> _bupdate = true;	
	}
	
	public function _out($s)
	{
		if($this -> _bupdate && $this -> state !=2)
		{
			$this-> _sout = $s."\n";
		} else {
			parent::_out($s);	
		}
	}
	
	public function endUpdate()
	{
		$this -> buffer  .= $this -> _sout;
		$this -> _sout 	  = "";
		$this -> _bupdate = false;	
	}
	
	public function endRow() {
		$this -> setX($this -> lMargin);
		$this -> Cell($this -> _ilX, $this -> _ibY - $this -> getY(), "", $this -> _sborderCol);
		$this -> setY($this -> _ibY);
		$this -> setX($this -> lMargin);
		$this -> _ilX = 0;
		$this -> _ibY = 0;
		if($this -> GetY() >= ($this -> h - $this -> bMargin)) $this -> AddPage();
		$this -> endUpdate();
		$this -> AutoPageBreak = true;	
	}

	public function fetchRow($data)
	{
		$row = &$this -> _ary['data'][];
		foreach($this -> _acols as $col)
		{
			$row[$col -> sindex] = strip_tags(str_replace('<br />', "\n", html_entity_decode(@$data[$col -> sindex])));
			if(!isset($this -> _ary['maxlength'][$col -> sindex]))
			{
				$this -> _ary['maxlength'][$col -> sindex] = $this -> GetStringWidth($col ->slabel) + 4;	
			}
			$this -> _ary['maxlength'][$col -> sindex] = max($this -> _ary['maxlength'][$col -> sindex], $this -> GetStringWidth($row[$col -> sindex]) + 4);
		}
	}
		
	private function _setCol($stext, $ocol)
	  {
	  	$posy  = $this -> GetY();
	  	$this -> MultiCell($ocol -> iwidth, $this -> _ihrow, $stext);
	  	$this -> _ibY = max($this -> _ibY, $this->GetY());
	  	$this -> SetXY($this -> _ilX + $this -> lMargin, $posy);
	  	$this -> _ilX += $ocol -> iwidth;
	  	$this -> SetXY($this -> lMargin + $this -> _ilX, $posy);
	}
	
	public function addPage()
	{
		parent::addPage();
		$this -> _drawColumnHeaders();
	}
	
	public function drawColumnHeaders(&$sfont, &$sstyle, &$ifontsize, &$irowheight, &$ialignement = "C")
	{
		/** Interface
		 */
	}
	
	public function drawRows(&$sfont, &$sstyle, &$ifontsize, &$irowheight)
	{
		/** Interface
		 */
	}
	
	public function Header() 
	{
		
	}
	
	public function Footer()
	{
		
	}
	
	public function autoSizeColumns()
	{
		$totvar = 0; $totfix = 0;
		foreach($this -> _acols as $col)
		{
			if($col -> bmultiline)
			{
				$totvar += $this -> _ary['maxlength'][$col -> sindex];
			} else {
				$totfix += $this -> _ary['maxlength'][$col -> sindex];
			}
		}
		$ipw = ($this -> w - $this -> lMargin - $this -> rMargin - $totfix);
		foreach($this -> _acols as $col)
		{
			if($col -> bmultiline)
			{
			    $col -> iwidth = (float)($this -> _ary['maxlength'][$col -> sindex] * $ipw / $totvar);
			} else {
				$col -> iwidth = (float)$this -> _ary['maxlength'][$col -> sindex];	
			}
		}	
	}
	
	public function _drawColumnHeaders()
	{
		$ialignement = "C";
		$this -> drawColumnHeaders($this -> FontFamily, $this -> FontStyle, $this -> FontSize, $this -> _ihrowH, $ialignement);
		foreach($this -> _acols as $col)
		{
			if($col -> iwidth > 0)
			{
				$this -> Cell($col -> iwidth, $this -> _ihrowH, $col -> slabel, 1, 0, $ialignement);
			}
		}
		$this -> Ln();
	}
	
	public function display($sfname = "", $mdest = "")
	{
		$this -> SetFont("Arial", "", 10);
		$this -> addPage();
		$this -> drawRows($this -> FontFamily, $this -> FontStyle, $this -> FontSize, $this -> _ihrow);
		foreach($this -> _ary['data'] as $row)
		{
			$this -> beginRow();
			foreach($this -> _acols as $col)
			{
				if($col -> iwidth > 0)
				{
					$this -> _setCol(@$row[$col -> sindex], $col);
				}
			}
			$this -> endRow();
		}
		$this -> Output($sfname, $mdest);
	}
	
}
?>