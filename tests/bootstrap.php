<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/TestCase.php';
require_once "PHPUnit/TextUI/TestRunner.php";
require_once "PHPUnit/Framework/TestSuite.php";

define('SKEBUILDER_BASE_TEST', realpath(dirname(__FILE__) . '/..') . '/');
define('SKEBUILDER_UNITTEST_EXPERIMENT_DIR', SKEBUILDER_BASE_TEST . 'tests/experiment/');
require SKEBUILDER_BASE_TEST . "init.php";
require SKEBUILDER_BASE_TEST . "src/skebuilder.php";
