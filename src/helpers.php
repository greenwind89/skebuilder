<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class Helpers {

	private $file_path_list = array();

	public function getFileList($container, $extension_array = array()) 
	{
		$dir = $container;
		if(is_dir($dir)) 
        {
        	if($dh = opendir($dir)) 
        	{
            	while(($file = readdir($dh)) !== false) 
            	{
                	if($file != '.' && $file != '..') 
                	{
                    	if(is_dir($dir . $file)) 
                    	{
                        	$this->getFileList($dir . $file . DIRECTORY_SEPARATOR, $extension_array);
						} 
						else
						{
							$full_path = $dir . $file;
							$path_parts = pathinfo($full_path);
							if(count($extension_array) > 0)
							{
								// if it is not what we want, ignore it
								if(!in_array($path_parts['extension'], $extension_array))
								{
									continue;
								}
							}
							$this->file_path_list[] = $full_path;
                        }
                	}
				}
        	}
        	closedir($dh);
        }

        return $this->file_path_list;
	}

	public function stripFileExtension($filename)
	{
		$new_file_name =  preg_replace("/\\.[^.\\s]{3,5}$/", "", $filename);

		// duple checking for the case: phpfox.class.php
		return preg_replace("/\\.[^.\\s]{3,5}$/", "", $new_file_name);

	}

	/**
	 * Forces a file to be downloaded by the end-user and at the same time
	 * try to hide the location of the file.
	 *
	 * @param string $sFile Full path to a file
	 * @param string $sName Name of the file when the user trys to download it
	 * @param string $sMimeType MIME type of the file in case we can't find it.
	 * @param string $sFileSize File size of the file in case we can't find it.
	 * @param string $iServerId Optional if the site has more then one server you need to specify the original location of the file with the servers ID#
	 */
	public function forceDownload($sFile, $sName, $sMimeType = '', $sFileSize = '', $iServerId = 0) 
	{	    
		// required for IE  
		if(ini_get('zlib.output_compression')) 
		{
			ini_set('zlib.output_compression', 'Off'); 
		}	
		
		if (!$sMimeType)
		{
			if (function_exists('mime_content_type'))
			{
				$sMimeType = mime_content_type($sFile);
			}
			else 
			{	     	
				if (strtolower(PHP_OS) == 'linux')
				{
					$sMimeType = trim(exec('file -bi ' . escapeshellarg($sFile)));
				}
				else
				{
		     		// get the file mime type using the file extension  
					switch(strtolower(substr(strrchr($sFile,'.'), 1)))  
					{  
						case 'pdf': 
						$sMimeType = 'application/pdf'; 
						break;  
						case 'zip': 
						$sMimeType = 'application/zip'; 
						break;  
						case 'jpeg':  
						case 'jpg': 
						$sMimeType = 'image/jpg'; 
						break;  
						default: 
						$sMimeType = 'application/force-download';  
			        		// $sMimeType = 'application/octet-stream';
					}
				}
			}
		}		
		


	    // Make sure there's not anything else left
		ob_clean();
	    /*
	    if ($iServerId && !file_exists($sFile))
	    {
	    	$sServer = Phpfox::getLib('request')->getServerUrl($iServerId);
	    	$sFileServer = $sServer . '/' .str_replace(PHPFOX_DIR, '', $sFile);
	    	$this->copy($sFileServer, $sFile);
	    	
	    }
		*/
	    // Start sending headers
	    header("Pragma: public"); // required
	    header("Expires: 0");
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header("Cache-Control: private", false); // required for certain browsers
	    header("Content-Transfer-Encoding: binary");
	    header("Content-Type: " . $sMimeType);
	    header("Content-Length: " . ($sFileSize ? $sFileSize : filesize($sFile)));
	    header("Content-Disposition: attachment; filename=\"" . $sName . "\";" );

	    // Send data
	    readfile($sFile);
	    
	    // If its stored in the cache folder delete it
	    if (preg_match('/\/(.*?)\.(.*?)/', $sFile))
	    {
	    	unlink($sFile);
	    }
	    
	}

	/**
	 * Deletes a directory and all the files and folders in it (recursive)
	 * 
	 * @param string $sPath Absolute path to the folder
	 */
	public function delete_directory($dir)
	{
        if(is_dir($dir)) 
        {
        	if($dh = opendir($dir)) 
        	{
            	while(($file = readdir($dh)) !== false) 
            	{
                	if($file != '.' && $file != '..') 
                	{
                    	if(is_dir($dir . '/' . $file)) 
                    	{
                        	self::delete_directory($dir . '/' . $file);
						} 
						else
						{
                        	unlink($dir . '/' . $file);
                         }
                	}
				}
        	}
        	closedir($dh);
        	rmdir($dir);
        }
	}
}