<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


class PrintVisitor implements visitor{
	// public function visit($node){
	// 	echo $node->getFullPath() . "\n";
	// }

	public function visit($node){
		echo $node->getFullPath() . "\n";
	}

	public function leave($node){
	}
}