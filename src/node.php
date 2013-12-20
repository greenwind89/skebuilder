<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class Node {
	/**
	 * context variable store the current position of folder 
	 * any file or folder created by folder object will reside in this context
	 *
	 * @var array of string ex: ['src'], ['src', 'contest'] ...
	 **/
	private $context = array();

	/**
	 *	root of the node, from root we develop the tree 
	 *
	 * @var string 
	 **/
	private $root = './';

	/**
	 * folder seperator
	 *
	 * @var string
	 **/
	private $seperator = DIRECTORY_SEPARATOR;

	private function getPathFromContext()
	{
		return $this->root . $this->seperator. implode($this->seperator, $this->context) . $this->seperator;
	}

	private function removeDirRecursive($dir)
	{
		if (!is_dir($dir) || is_link($dir)) return @unlink($dir); 
        foreach (scandir($dir) as $file) { 
            if ($file == '.' || $file == '..') continue; 
            if (!$this->removeDirRecursive($dir . DIRECTORY_SEPARATOR . $file)) { 
                chmod($dir . DIRECTORY_SEPARATOR . $file, 0777); 
                if (!$this->removeDirRecursive($dir . DIRECTORY_SEPARATOR . $file)) return false; 
            }; 
        } 
        return @rmdir($dir); 
	}

	/**
	 * go to the next folder specified in parameter
	 * @param  string $name name or path to folder we want to go to
	 * @return boolean       true if the folder or the path existed in current context, false if vice versal 
	 */
	public function goNext($path)
	{
		// check malform path here
		$real_path = $this->getPathFromContext() . $path;
		if(!is_dir($real_path))
		{
			return false;
		}


		$nodes = explode($this->seperator, $path);

		foreach ($nodes as $node) {
			array_push($this->context, $node);
		}

		return true;
		
	}

	public function goBack()
	{
		array_pop($this->context);
	}

	public function createFolder($folder_name)
	{
		$current_dir = $this->getPathFromContext() . $folder_name;
		return @mkdir($current_dir);
	}

	public function removeFolder($folder_name)
	{
		$current_dir = $this->getPathFromContext() . $folder_name;
		return $this->removeDirRecursive($current_dir);
	}

	public function getCurrentContextPath()
	{
		return $this->getPathFromContext();
	}

	public function resetContext()
	{
		$this->context = array();
	}

	/**
	 * set root of current context
	 * note that it will be consider from the root of http server
	 * @param string $path path to expected context for ex: 'src/test/abc'
	 */
	public function setRootContext($path)
	{
		if(!is_dir($path))
		{
			return false;
		}

		$this->root = $path;

		return true;
	}

	public function getRoot()
	{
		return $this->root;
	}

	public function getCurrentNode()
	{
		return end($this->context);	
	}

	public function is_dir($dir)
	{
		$dir = $this->getPathFromContext() . $dir;
		return is_dir($dir);
	}

	/**
	 * at leaf we can create a folder or a file
	 * @todo: a file may need a template -> how to know what template for this file
	 * @param return
	 * @return return
	 */
	public function createLeaf($name)
	{
		if(strstr($name, '.'))
		{
			return $this->createFile($name);
		}
		else
		{
			return $this->createFolder($name);
		}
	}

	public function createFile($file_name)
	{
		$file_path = $dir = $this->getPathFromContext() . $file_name;
		if(!$fp = fopen($file_path, 'w'))
		{
			return false;
		}
		fclose($fp);
		return  true;
	}


}