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
 * @package  		Module_jobposting
 */

class Jobposting_Component_Controller_Admincp_Category_Add extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		$bIsEdit = false;
		if ($iEditId = $this->request()->getInt('id'))
		{
			if ($aCategory = Phpfox::getService('jobposting.category')->getForEdit($iEditId))
			{
				$bIsEdit = true;
				
				$this->template()->setHeader('<script type="text/javascript">$(function(){$(\'#js_mp_category_item_' . $aCategory['parent_id'] . '\').attr(\'selected\', true);});</script>')->assign('aForms', $aCategory);
			}
		}		
		
		if ($aVals = $this->request()->getArray('val'))
		{
			if ($bIsEdit)
			{
				if (Phpfox::getService('jobposting.category.process')->update($aCategory['category_id'], $aVals))
				{
					$this->url()->send('admincp.jobposting.category.add', array('id' => $aCategory['category_id']), Phpfox::getPhrase('jobposting.category_successfully_updated'));
				}
			}
			else 
			{
				if (Phpfox::getService('jobposting.category.process')->add($aVals))
				{
					$this->url()->send('admincp.jobposting.category.add', null, Phpfox::getPhrase('jobposting.category_successfully_added'));
				}
			}
		}
		
		$this->template()->setTitle(($bIsEdit ? Phpfox::getPhrase('jobposting.edit_a_category') : Phpfox::getPhrase('jobposting.create_a_new_category')))
			->setBreadcrumb(($bIsEdit ? Phpfox::getPhrase('jobposting.edit_a_category') : Phpfox::getPhrase('jobposting.create_a_new_category')), $this->url()->makeUrl('admincp.[jobposting'))
			->assign(array(
					'sOptions' => Phpfox::getService('jobposting.category')->display('option')->get(),
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
		(($sPlugin = Phpfox_Plugin::get('jobposting.component_controller_admincp_add_clean')) ? eval($sPlugin) : false);
	}
}

?>