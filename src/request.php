<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class Request {

	/**
	 * List of all the requests ($_GET, $_POST, $_FILES etc...)
	 *
	 * @var array
	 */
	private $_aArgs = array();


	/** 
     * Trims params and strip slashes if magic_quotes_gpc is set.
     *
     * @param mixed $mParam request params
     * @return mixed trimmed params.
     */
    private function _trimData($mParam)
    {		
    	if (is_array($mParam))
		{
			return array_map(array(&$this, '_trimData'), $mParam);
		}

		if (get_magic_quotes_gpc())
		{
			$mParam = stripslashes($mParam);
		}
		
		$mParam = trim($mParam);

		return $mParam;
    }

	/**
	 * Class Constructor used to build the variable $this->_aArgs.
	 * 
	 */
	public function __construct()
	{
		$this->_aArgs = $this->_trimData(array_merge($_GET, $_POST, $_FILES));	
		var_dump($this->_aArgs);			
	}
}