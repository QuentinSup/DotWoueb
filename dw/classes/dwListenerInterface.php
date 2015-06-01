<?php

namespace dw\classes;

/**
 * Interface de base pour implémenter les listeners
 * @author Quentin Supernant
 * @version 1.0
 * @package dotWoueb
 */
 
interface dwListenerInterface 
{
	public function init();
	public function prepareRequest();
	public function processRequest();
	public function terminateRequest();
}

?>