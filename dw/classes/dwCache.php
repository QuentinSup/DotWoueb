<?php

namespace dw\classes;

abstract class dwCache
{
	abstract public function setCache($scacheID, $object);
	abstract public function getCache($scacheID);
	
}

?>