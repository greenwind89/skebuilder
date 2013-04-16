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
		if ($aOrder = $this->request()->getArray('order'))
		{
			if (Phpfox::getService('[skebuilder:module_name].category.process')->updateOrder($aOrder))
			{
				$this->url()->send('admincp.[skebuilder:module_name].category', null, Phpfox::getPhrase('[skebuilder:module_name].category_order_successfully_updated'));
			}
		}		
		
		if ($iDelete = $this->request()->getInt('delete'))
		{
			if (Phpfox::getService('[skebuilder:module_name].category.process')->delete($iDelete))
			{
				$this->url()->send('admincp.[skebuilder:module_name]', null, Phpfox::getPhrase('[skebuilder:module_name].category_successfully_deleted'));
			}
		}
	
		$this->template()->setTitle(Phpfox::getPhrase('[skebuilder:module_name].manage_categories'))
			->setBreadcrumb(Phpfox::getPhrase('[skebuilder:module_name].manage_categories'), $this->url()->makeUrl('admincp.[skebuilder:module_name].category'))
			->setPhrase(array('[skebuilder:module_name].are_you_sure_this_will_delete_all_item_that_belong_to_this_category_and_cannot_be_undone'))
			->setHeader(array(
					'jquery/ui.js' => 'static_script',
					'admin.js' => 'module_[skebuilder:module_name]',
					'<script type="text/javascript">$Core.[skebuilder:module_name].url(\'' . $this->url()->makeUrl('admincp.[skebuilder:module_name].category') . '\');</script>'
				)
			)
			->assign(array(
					'sCategories' => Phpfox::getService('[skebuilder:module_name].category')->display('admincp')->get()
				)
			);	
	}
	
	/**
	 * Garbage collector. Is executed after this class has completed
	 * its job and the template has also been displayed.
	 */
	public function clean()
	{
		(($sPlugin = Phpfox_Plugin::get('[skebuilder:module_name].component_controller_admincp_index_clean')) ? eval($sPlugin) : false);
	}
}

?>