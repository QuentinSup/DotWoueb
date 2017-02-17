<?php

namespace dw\classes;

interface dwI18nInterface
{
	public function get($stag, $sdefaultvalue = null);
	public function set($stag, $svalue);
	public function exists($mtag);
}

?>