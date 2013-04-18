<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class PhpfoxHandler implements HandlerInterface{
	public function process() {
		if(count($_POST) > 0)
		{
			$this->_downloadNewPackage();
		}
		else {
			require(SKEBUILDER_BASE . 'view' . DIRECTORY_SEPARATOR . 'phpfox.php');
		}
		
		
	}

	private function _downloadNewPackage() {
		$module_name = $_POST['module_name'];
		$package_id = $_POST['package_id'];
		$skeleton_name = $_POST['skeleton_name'];
		$item_name = $_POST['item_name'];
		$author_name = $_POST['author_name'];


		$helpers = new Helpers;
		$archive = new Archive;

		$context = new Context(SKEBUILDER_CACHE_DIR);
		$context->setModuleName($module_name);
		$context->setPackageId($package_id);
		$context->setItemName($item_name);
		$context->setAuthorName($author_name);

		$xml_parser = new parser();

		$data = $xml_parser->parseSkeleton(SKEBUILDER_SKELETON_DIR . $skeleton_name. '.xml');
		$build_visitor = new buildVisitor($context);
		$data->accept($build_visitor);

		if(!$archive_path = $archive->compress($name_of_zip = $module_name, $name_of_compressed_folder = 'upload'))
		{
			$helpers->delete_directory(SKEBUILDER_CACHE_DIR . 'upload');
			echo 'compress failed';
			return false;
		}

		$helpers->delete_directory(SKEBUILDER_CACHE_DIR . 'upload');
		
		$helpers->forceDownload($archive_path, 'exported_' . $module_name . '.zip');
		@unlink($archive_path);

		echo 'Thank you';
		exit;
	}
}