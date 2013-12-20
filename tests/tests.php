<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class skebuilder_test extends PHPUnit_Framework_TestCase {
	public function __constructor($name) {
		parent::__constructor($name);
	}

	public function test1() {
		$oSKebuilder = new Skebuilder;
		$this->assertEquals(1, $oSKebuilder->return1());
	}

}

