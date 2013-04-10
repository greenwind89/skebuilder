<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-04-05 at 10:09:54.
 */
class filenodeTest extends PHPUnit_Framework_TestCase
{

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        @unlink(SKEBUILDER_UNITTEST_EXPERIMENT_DIR . 'test.mm');
    }

    public function testCreateEmptyNode(){
        $node = new FileNode('');

        $this->assertFalse($node->create(SKEBUILDER_UNITTEST_EXPERIMENT_DIR));

        $node = new FileNode('    ');

        $this->assertFalse($node->create(SKEBUILDER_UNITTEST_EXPERIMENT_DIR));
    }

    public function testCreateWithoutTemplate(){
        $node = new FileNode('test.mm');

        $node->create(SKEBUILDER_UNITTEST_EXPERIMENT_DIR);

        $this->assertTrue(file_exists(SKEBUILDER_UNITTEST_EXPERIMENT_DIR . 'test.mm'));

    }

    /**
     * @covers filenode::create
     */
    public function testCreateWithTemplate()
    {
        //setup
        $node = new FileNode('test.mm', SKEBUILDER_BASE_TEST . 'src/template/phpfox/phpfox_block_class.php'); 
        
        //make change
        $result = $node->create(SKEBUILDER_UNITTEST_EXPERIMENT_DIR);

        //expect
        $this->assertTrue($result);

        $this->assertTrue(file_exists(SKEBUILDER_UNITTEST_EXPERIMENT_DIR . 'test.mm'));

    }


    /**
     * @covers private filenode::writeTemplateToNewCreatedFile(file_handler)
     */
    public function testPrivateWriteTemplateToNewCreatedFile()
    {
        // ----------------------------------------------------------------
        // setup your test
        $file_hanlder = fopen(SKEBUILDER_UNITTEST_EXPERIMENT_DIR . 'test.mm', 'w');

        $node = new FileNode('test.mm', SKEBUILDER_BASE_TEST . 'src/template/phpfox/phpfox_block_class.php');

        // because writeTemplateToNewCreatedFile is a private method => we need to set it accessible first
        $method = new ReflectionMethod(
            'FileNode', 'writeTemplateToNewCreatedFile'
        );
        $method->setAccessible(TRUE);
 
        $this->assertTrue(
            $method->invoke($node, $file_hanlder), Skebuilder::getErrorMessages()
        );

        $this->assertTrue(file_exists(SKEBUILDER_UNITTEST_EXPERIMENT_DIR . 'test.mm'));

        fclose($file_hanlder);
    
    }
    
    
}