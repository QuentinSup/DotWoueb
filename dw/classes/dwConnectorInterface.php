<?php

namespace dw\classes;

interface dwConnectorInterface {
	
	public static function getName();
	public function digestConfig($xml);
	public function prepare();
	public function getInstance();
	
}