<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class OxwallHandler implements HandlerInterface{
	public function process() {
		if(count($_POST) > 0)
		{
			$this->_downloadNewPackage();
		}
		else {
			require(SKEBUILDER_BASE . 'view' . DIRECTORY_SEPARATOR . 'oxwall.php');
		}
		
		
	}

	private function _downloadNewPackage() {
		
	}
}