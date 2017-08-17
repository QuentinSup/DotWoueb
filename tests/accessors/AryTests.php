<?php

include_once ('../init.php');

use PHPUnit\Framework\TestCase;
use dw\accessors\ary;


class AryTests extends TestCase {
	public function testSetMethod() {
		$ary = array ();
		ary::set ( $ary, 'test', 'unit' );
		
		$this->assertEquals ( $ary ['test'], 'unit' );
	}
}

?>