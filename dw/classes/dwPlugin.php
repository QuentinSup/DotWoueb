<?php

namespace dw\classes;

/**
 * Interface de base pour implementer des Plug-Ins dans le framework
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */
 
interface dwPluginInterface 
{
	public function install();
	public function uninstall();
	public function prepare();
	public function prepareRequest(dwHttpRequest $request, dwHttpResponse $response, dwModel $model);
	public function processRequest(dwHttpRequest $request, dwHttpResponse $response, dwModel $model);
	public function terminateRequest(dwHttpRequest $request, dwHttpResponse $response, dwModel $model);
}

abstract class dwPlugin extends dwXMLConfig implements dwPluginInterface
{
	protected $_sroot;
	
	public function install() {}
	public function uninstall() {}
	public function prepareRequest(dwHttpRequest $request, dwHttpResponse $response, dwModel $model) {}
	public function processRequest(dwHttpRequest $request, dwHttpResponse $response, dwModel $model) {}
	public function terminateRequest(dwHttpRequest $request, dwHttpResponse $response, dwModel $model) {}
	
	public function __construct($sname = null)
	{
		$this -> _name = $sname;
	}
	
	public function root()
	{
		return $this -> _sroot;
	}
	
	public function prepare($curPath = ".", $sXml = 'config.xml', $sencoding = 'ISO-8859-1') 
	{
		 $this -> _sroot = $curPath.'/';
		 $this -> loadConfig($curPath.'/', $sXml, $sencoding);
	}
		
}
 
?>