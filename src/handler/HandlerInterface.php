<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */

require(SKEBUILDER_SRC_DIR . DIRECTORY_SEPARATOR . 'handler' . DIRECTORY_SEPARATOR . 'PhpfoxHandler.php');
require(SKEBUILDER_SRC_DIR . DIRECTORY_SEPARATOR . 'handler' . DIRECTORY_SEPARATOR . 'OxwallHandler.php');

Interface HandlerInterface {

	public function process();

}