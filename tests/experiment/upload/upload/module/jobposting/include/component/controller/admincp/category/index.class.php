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

class Jobposting_Component_Controller_Admincp_Category_Index extends Phpfox_Component
{
	/**
	 * Class process method wnich is used to execute this component.
	 */
	public function process()
	{
		if ($aOrder = $this->request()->getArray('order'))
		{
			if (Phpfox::getService('jobposting.category.process')->updateOrder($aOrder))
			{
				$this->url()->send('admincp.jobposting.category', null, Phpfox::getPhrase('jobposting.category_order_successfully_updated'));
			}
		}		
		
		if ($iDelete = $this->request()->getInt('delete'))
		{
			if (Phpfox::getService('jobposting.category.process')->delete($iDelete))
			{
				$this->url()->send('admincp.jobposting', null, Phpfox::getPhrase('jobposting.category_successfully_deleted'));
			}
		}
	
		$this->template()->setTitle(Phpfox::getPhrase('jobposting.manage_categories'))
			->setBreadcrumb(Phpfox::getPhrase('jobposting.manage_categories'), $this->url()->makeUrl('admincp.jobposting.category'))
			->setPhrase(array('jobposting.are_you_sure_this_will_delete_all_item_that_belong_to_this_category_and_cannot_be_undone'))
			->setHeader(array(
					'jquery/ui.js' => 'static_script',
					'admin.js' => 'module_jobposting',
					'<script type="text/javascript">$Core.jobposting.url(\'' . $this->url()->makeUrl('admincp.jobposting.category') . '\');</script>'
				)
			)
			->assign(array(
					'sCategories' => Phpfox::getService('jobposting.category')->display('admincp')->get()
				)
			);	
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('jobposting.component_controller_admincp_index_clean')) ? eval($sPlugin) : false);
	}
}

?>