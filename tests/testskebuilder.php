<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class skebuilder_test extends PHPUnit_Framework_TestCase {
	/**
	 * skebuilder object
	 *
	 * @var skebuilder
	 **/
	private $skebuilder;

	public function __constructor($name) {
		parent::__constructor($name);
	}

	/**
	 * set up test environment
	 */
	public function setUp() {
		$this->skebuilder = new Skebuilder();
		$node = $this->skebuilder->getNode()->setRootContext('tests');
		$this->skebuilder->getNode()->removeFolder('generateFolder');
	}

	public function tearDown() {
		$this->skebuilder->getNode()->resetContext();
		$this->skebuilder->getNode()->removeFolder('generateFolder');
		$this->skebuilder->getNode()->removeFolder('skebuilder_test');

	}


	public function testGeneratePhpfoxModule() {
		$module_name = 'skebuilder_test';
		$package_type = 'phpfox';
		$repository_location = 'tests';

		$this->assertTrue($this->skebuilder->generate($module_name, $package_type, $repository_location));

		$this->skebuilder->getNode()->resetContext();
		$node = $this->skebuilder->getNode()->setRootContext('tests');

		$this->assertTrue($this->skebuilder->getNode()->goNext($module_name));

		$this->assertTrue($this->skebuilder->getNode()->is_dir('include'));
		$this->assertTrue($this->skebuilder->getNode()->is_dir('static'));
		$this->assertTrue($this->skebuilder->getNode()->is_dir('template'));

	}
}

