<? 
require('init.php');
require(SKEBUILDER_BASE . 'src' . SKEBUILDER_DS . 'skebuilder.php');

$module_name = $_POST['module_name'];

// generate folder structure from module name
$oSkebuilder = new Skebuilder();
$archive = new Archive();

chmod(SKEBUILDER_FILES_DIR, 0777);
chmod(SKEBUILDER_CACHE_DIR, 0777);

if($oSkebuilder->generate($module_name, 'phpfox', SKEBUILDER_CACHE_DIR ))
{
	if($archive_path = $archive->compress($name_of_zip = $module_name, $name_of_compressed_folder = $module_name))
	{

		$oSkebuilder->delete_directory(SKEBUILDER_CACHE_DIR . $module_name);
		@unlink($archive_path);
		// $oSkebuilder->forceDownload($archive_path, 'exported_' . $module_name . '.zip');
	}
	else {
		echo 'compress fail';
	}
}
else
{
	echo 'fail';
}

// zip and stream file 