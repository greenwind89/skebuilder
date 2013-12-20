<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class compositenode_test extends PHPUnit_Framework_TestCase {
	public function __constructor($name) {
		parent::__constructor($name);
	}

	/**
	 * skeleton builder
	 *
	 * @var skebuilder object
	 **/
	private $skeleton_builder;

	const TEST_FOLDER = 'tests';

	public function setUp() {
		$skeleton_builder = new Skebuilder();
	}
	
	public function testBuildCompositeTreeFromStructure() {
		$node1 = new FolderNode('testCompositeTree');
		$node2 = new FolderNode('test2');
		$node3 = new FileNode('test3.html');
		$node4 = new FileNode('test4.html');
		$node2->add($node3);
		$node1->add($node2);
		$node1->add($node4);
		// $node1->create('tests/resource' . DIRECTORY_SEPARATOR);
	}


}

