<?php

namespace dw\classes;

interface dwTraducerInterface
{
	public function get($stag, $sdefaultvalue = null);
	public function set($stag, $svalue);
	public function exists($mtag);
}

?>