<? 

define('SKEBUILDER_DS', DIRECTORY_SEPARATOR);
define('SKEBUILDER_BASE', dirname(__FILE__) . SKEBUILDER_DS);

require(SKEBUILDER_BASE . 'init.php');

require(SKEBUILDER_BASE . 'src' . SKEBUILDER_DS . 'skebuilder.php');


// generate folder structure from module name
$oSkebuilder = new Skebuilder();


$oSkebuilder::run();


