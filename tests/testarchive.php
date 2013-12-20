<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class archive_test extends PHPUnit_Framework_TestCase {
	/**
	 * skeleton object
	 *
	 * @var skeleton
	 **/
	private $archive;

	public function __constructor($name) {
		parent::__constructor($name);
	}

	/**
	 * set up test environment
	 */
	public function setUp() {
		$this->archive = new Archive();
	}

	public function testGetAllFiles() {

		$aFileNames = $this->archive->getAllFiles('tests/resource/', $bRecursive = true);
		$this->assertEquals(2, count($aFileNames));
	}

	public function testCompress()
	{
		// $this->archive->setCompressFolder('tests/resource');
		$path = $this->archive->compress($name_of_zip = 'skebuilder_test', $name_of_compressed_folder = 'minhta');

		$this->assertTrue(file_exists($path));
	}
}

