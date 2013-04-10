<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class Archive {

	/**
	 * location of the folder to be compressed and zip file must be the same
	 * because zip read relative path and generate all folder in the path
	 *
	 * @var string
	 **/
	private $compress_folder = SKEBUILDER_CACHE_DIR;

	/**
	 * set compressfolder
	 */
	public function setCompressFolder ($path)
	{
		$this->compress_folder = $path;
	}


	public function __construct()
	{
		if (class_exists('ZipArchive'))
		{
			$this->_oZip = new ZipArchive;
		}
	}


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

	/**
	 * Compress data into the archive
	 *
	 * @param string $sFileName Name of the ZIP file
	 * @param string $sFolderPath Name of the folder we are going to compress. 
	 * @return mixed Returns the full path to the newly created ZIP file.
	 */	
	public function compress($sFileName, $sCompressedFolder)
	{		
		// Create random ZIP
		$sArchive = $this->compress_folder . md5($sFileName) . '.zip';
		chmod($this->compress_folder, 0777);
		chdir($this->compress_folder);

		if (is_object($this->_oZip))
		{			
			if ($res = $this->_oZip->open($sArchive, ZIPARCHIVE::CREATE))
			{
				$aFiles =$this->getAllFiles($sCompressedFolder);							
				
				foreach ($aFiles as $sNewFile)
				{
					$sNewFile = str_replace($this->compress_folder, '', $sNewFile);

					$this->_oZip->addFile($sNewFile);	
				}				
				
	    		if(!$this->_oZip->close())     			    	
	    		{
	    			return false;
	    		}
			}
			else
			{
				die ("Could not open archive");
			}		
		}
		else 
		{	
			// shell_exec(Phpfox::getParam('core.zip_path') . ' -r ' . escapeshellarg($sArchive) . ' ./');			
		}	
		
		// chdir($_SERVER['DOCUMENT_ROOT']);
		chdir(SKEBUILDER_BASE); 
		 // current directory
		return $sArchive;
	}


	/**
	 * Gets all files/folders in a give directory recursively.
	 *
	 * @param string $sDir Full path to the directory
	 * @param bool $bRecurse TRUE if we are in a recursive check or FALSE if we are not.
	 * @return array List of all the files/folders in a folder.
	 */
	public function getAllFiles($sDir, $bRecurse = false)
	{
		static $aFiles = array();
		
		if ($bRecurse === false)
		{
			$aFiles = array();
		}
		
		$hDir = opendir($sDir);
		while ($sFile = readdir($hDir))
		{
			if ($sFile == '.' || $sFile == '..' || $sFile == '.svn')
			{
				continue;
			}
			

			$sNewDir = rtrim($sDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $sFile;
			if (is_dir($sNewDir))
			{
				$this->getAllFiles($sNewDir, true);
			}
			else 
			{
				$aFiles[] = $sNewDir;
			}	
		}
		
		return $aFiles;	
	}

}