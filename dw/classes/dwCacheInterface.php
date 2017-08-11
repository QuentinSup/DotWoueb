<?php

namespace dw\classes;

/**
 * Cache interface
 *
 */
interface dwCacheInterface {
	public function put($object);
	public function get();
}

?>