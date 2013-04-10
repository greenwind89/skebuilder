<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class Helpers {
	public function compressFolder($sPath)
	{
		$path = $sPath;
		$zip = new ZipArchive;
		$zip->open('file.zip', ZipArchive::CREATE);
		echo 'fdafdsa';
		if (false !== ($dir = opendir($path)))
	     {
	         while (false !== ($file = readdir($dir)))
	         {
	             if ($file != '.' && $file != '..')
	             {
	                       $zip->addFile($path.DIRECTORY_SEPARATOR.$file);
	                       //delete if need
	                       if($file!=='important.txt') 
	                         unlink($path.DIRECTORY_SEPARATOR.$file);
	             }
	         }
	     }
	     else
	     {
	         die('Can\'t read dir');
	     }

	    $zip->close();
	}
}