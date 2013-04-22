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


defined('PHPFOX') or exit('NO DICE!');

class [skebuilder:block_class_name] extends Phpfox_component {

    public function process() {
        $bIsProfile = false;
        if ($this->getParam('bIsProfile') === true && ($aUser = $this->getParam('aUser'))) {
            $bIsProfile = true;
        }

        $aCategories = Phpfox::getService('[skebuilder:module_name].category')->getForBrowse();
        if (!is_array($aCategories)) {
            return false;
        }

        if (!$aCategories) {
            return false;
        }

        foreach ($aCategories as $iKey => $aCategory) {
            $aCategories[$iKey]['url'] = ($bIsProfile ? $this->url()->permalink(array($aUser['user_name'] . '.[skebuilder:module_name].category', 'view' => $this->request()->get('view')), $aCategory['category_id'], $aCategory['name']) : $this->url()->permalink(array('[skebuilder:module_name].category', 'view' => $this->request()->get('view')), $aCategory['category_id'], $aCategory['name']));
            if (isset($aCategory['sub'])) {
                foreach ($aCategories[$iKey]['sub'] as $iSubKey => $aSubCategory) {
                    $aCategories[$iKey]['sub'][$iSubKey]['url'] = ($bIsProfile ? $this->url()->permalink(array($aUser['user_name'] . '.[skebuilder:module_name].category', 'view' => $this->request()->get('view')), $aSubCategory['category_id'], $aSubCategory['name']) : $this->url()->permalink(array('[skebuilder:module_name].category', 'view' => $this->request()->get('view')), $aSubCategory['category_id'], $aSubCategory['name']));
                }
            }
        }

     
        $this->template()->assign(array(
            'sHeader' => Phpfox::getPhrase('[skebuilder:module_name].categories'),
            'aCategories' => $aCategories,
            'iCategoryItemView' => $this->request()->getInt('req3')
                )
        );

        (($sPlugin = Phpfox_Plugin::get('[skebuilder:module_name].component_block_categories_process')) ? eval($sPlugin) : false);

        return 'block';
    }

    public function clean() {
        $this->template()->clean(array(
            'aCategories'
                )
        );

        (($sPlugin = Phpfox_Plugin::get('[skebuilder:module_name].component_block_categories_clean')) ? eval($sPlugin) : false);
    }

}