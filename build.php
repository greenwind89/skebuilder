<? 

define('SKEBUILDER_DS', DIRECTORY_SEPARATOR);
define('SKEBUILDER_BASE', dirname(__FILE__) . SKEBUILDER_DS);

require(SKEBUILDER_BASE . 'init.php');

require(SKEBUILDER_BASE . 'src' . SKEBUILDER_DS . 'skebuilder.php');

$module_name = $_POST['module_name'];
$package_type = $_POST['package_type'];

// generate folder structure from module name
$oSkebuilder = new Skebuilder();
$archive = new Archive();

chmod(SKEBUILDER_FILES_DIR, 0777);
chmod(SKEBUILDER_CACHE_DIR, 0777);


if($oSkebuilder->generate($module_name, $package_type, SKEBUILDER_CACHE_DIR ))
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
	echo 'generate fail';
}

// zip and stream file 