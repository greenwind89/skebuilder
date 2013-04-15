<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


/**
 * because data parsed form XML parse is not adapted with our existing stucture generator algorithm
 * we use a adapter pattern here to adapt the data
 */
Class XMLParserDataToSkeletonArrayAdapter extends XMLParser implements parserInterface{
	private $_replacement;
	public function parseSkeleton($file_path)
	{
		$data = $this->parse($file_path);

		if(isset($data['data']['replacement_class']))
		{
			Skebuilder::setSkeletonReplacement($data['data']['replacement_class']);
		}
		else
		{
			Skebuilder::setSkeletonReplacement('ReplacementDefault');
		}
		
		//translate it into our expected structure
		$root_node = new FolderNode('upload');
		$this->buildCompositeNodeTreeFromParsedArray($data['structure'], $root_node);
		return $root_node;
	}

	// data must always have a root
	public function buildCompositeNodeTreeFromParsedArray($data, $root_node)
	{
		foreach ($data as $key => $value) {
			// it is not a leaf
			if(isset($value['node']))
			{
				$new_node = new FolderNode($value['name']);
				//trick part here
				//we do it because $value['node'] can be array of value of array of array 
				//in case it is array of true value, we make it an array of array

				$this->buildCompositeNodeTreeFromParsedArray(isset($value['node']['type']) ? array($value['node']) : $value['node'], $new_node);
			}
			else
			{
				// it is a leaf
				if($value['type'] === 'folder')
				{
					$new_node = new FolderNode($value['name']);
				}
				else if($value['type'] === 'file')
				{
					$new_node = new FileNode($value['name'], isset($value['template']) ? $value['template'] : null);
				}
			}

			$root_node->add($new_node);
		}


	}

}
