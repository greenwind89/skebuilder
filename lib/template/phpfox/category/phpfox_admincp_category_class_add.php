<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[YOUNET_COPPYRIGHT]
 * @author  		[skebuilder:author]
 * @package  		Module_[skebuilder:module_name]
 */

class [skebuilder:controller_class_name] extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		$bIsEdit = false;
		if ($iEditId = $this->request()->getInt('id'))
		{
			if ($aCategory = Phpfox::getService('[skebuilder:module_name].category')->getForEdit($iEditId))
			{
				$bIsEdit = true;
				
				$this->template()->setHeader('<script type="text/javascript">$(function(){$(\'#js_mp_category_item_' . $aCategory['parent_id'] . '\').attr(\'selected\', true);});</script>')->assign('aForms', $aCategory);
			}
		}		
		
		if ($aVals = $this->request()->getArray('val'))
		{
			if ($bIsEdit)
			{
				if (Phpfox::getService('[skebuilder:module_name].category.process')->update($aCategory['category_id'], $aVals))
				{
					$this->url()->send('admincp.[skebuilder:module_name].category.add', array('id' => $aCategory['category_id']), Phpfox::getPhrase('[skebuilder:module_name].category_successfully_updated'));
				}
			}
			else 
			{
				if (Phpfox::getService('[skebuilder:module_name].category.process')->add($aVals))
				{
					$this->url()->send('admincp.[skebuilder:module_name].category.add', null, Phpfox::getPhrase('[skebuilder:module_name].category_successfully_added'));
				}
			}
		}
		
		$this->template()->setTitle(($bIsEdit ? Phpfox::getPhrase('[skebuilder:module_name].edit_a_category') : Phpfox::getPhrase('[skebuilder:module_name].create_a_new_category')))
			->setBreadcrumb(($bIsEdit ? Phpfox::getPhrase('[skebuilder:module_name].edit_a_category') : Phpfox::getPhrase('[skebuilder:module_name].create_a_new_category')), $this->url()->makeUrl('admincp.[[skebuilder:module_name]'))
			->assign(array(
					'sOptions' => Phpfox::getService('[skebuilder:module_name].category')->display('option')->get(),
					'bIsEdit' => $bIsEdit
				)
			);
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('[skebuilder:module_name].component_controller_admincp_add_clean')) ? eval($sPlugin) : false);
	}
}

?>