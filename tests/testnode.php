<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class node_test extends PHPUnit_Framework_TestCase {
	/**
	 * node object
	 *
	 * @var node
	 **/
	private $node;

	public function __constructor($name) {
		parent::__constructor($name);
	}

	/**
	 * set up test environment
	 */
	public function setUp() {
		$this->node = new Node();
		$this->node->setRootContext('tests');
	}

	public function tearDown() {
	}

	public function testSetRoot() {
		$this->assertTrue($this->node->setRootContext('tests'));
	}

	public function testGoNext() {
		$this->assertTrue($this->node->goNext('resource'));
		$this->assertEquals($this->node->getCurrentNode(), 'resource');

		$this->assertTrue($this->node->goNext('mm'));
		$this->assertEquals($this->node->getCurrentNode(), 'mm');

	}

	public function testGoBack() {
		$this->node->goNext('resource');
		$this->node->goNext('mm');

		$this->node->goBack();
		$this->assertEquals($this->node->getCurrentNode(), 'resource');

	}

	public function testCreateFolder() {
		$this->node->goNext('resource');
		$this->node->goNext('mm');
		$this->node->createFolder('haha');

		$this->assertTrue($this->node->goNext('haha'));

		$this->node->createFolder('hehe');
		$this->assertTrue($this->node->goNext('hehe'));
	}

	public function testRemoveFolder() {
		$this->node->goNext('resource');
		$this->node->goNext('mm');
		$this->node->createFolder('haha');

		$this->node->goNext('haha');
		$this->node->createFolder('hehe');

		$this->assertTrue($this->node->removeFolder('hehe'));

		// it is deleted, so we should return false
		$this->assertFalse($this->node->removeFolder('haha'));

		$this->node->goBack();

		$this->assertTrue($this->node->removeFolder('haha'));
	}


}

