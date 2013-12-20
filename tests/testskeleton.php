<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class skeleton_test extends PHPUnit_Framework_TestCase {
	/**
	 * skeleton object
	 *
	 * @var skeleton
	 **/
	private $skeleton;

	public function __constructor($name) {
		parent::__constructor($name);
	}

	/**
	 * set up test environment
	 */
	public function setUp() {
		$this->skeleton = new Skeleton();
	}
	public function testSetSkeleton() {
		$structure = array('test' => 'test');
		$this->skeleton->setPhpfoxSkeleton($structure);
		$this->assertEquals($structure, $this->skeleton->getSkeleton('phpfox'));
	}
}

