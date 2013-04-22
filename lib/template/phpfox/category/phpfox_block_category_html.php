<?php 
/**
 * [PHPFOX_HEADER]
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>

<div class="sub_section_menu">
	<ul>
	{foreach from=$aCategories item=aCategory}
		<li class="{if $iCategoryItemView == $aCategory.category_id} active{/if}"><a href="{$aCategory.url}" class="ajax_link">{$aCategory.name|convert|clean}</a>
                 
                    {if isset($aCategory.sub) && count($aCategory.sub)}
                <ul>
                      {foreach from=$aCategory.sub item=aSubCategory key=iKey}                    
                    <li class="{if $iCategoryItemView == $aSubCategory.category_id} active{/if} {if isset($sModule)}{$sModule}_{/if}subcategory_{$aCategory.category_id} special_subcategory" {if $iKey >= Phpfox::getParam('[skebuilder:module_name].subcategories_to_show_at_first')}style="display:none;"{/if}>
                      <a href="{$aSubCategory.url}" id="{if isset($sModule)}{$sModule}_{/if}subcategory_{$aSubCategory.category_id}" class="ajax_link">
                                {$aSubCategory.name|convert|clean}
                      </a>
                    </li>
                      {/foreach}
          
                      {if $iKey >= Phpfox::getParam('[skebuilder:module_name].subcategories_to_show_at_first') && Phpfox::getParam('fundraising.subcategories_to_show_at_first') > 0}
                    <li onclick="$Core.toggleCategory('{if isset($sModule)}{$sModule}_{/if}subcategory_{$aCategory.category_id}',{$aCategory.category_id})">
                      <div id="show_more_{$aCategory.category_id}" style="text-align:right;vertical-align:middle;"><a href="#" onclick="return false;">{img theme='misc/plus.gif' class='v_middle'}{phrase var='user.view_more'}</a></div>
                      <div id="show_less_{$aCategory.category_id}" style="display:none;text-align:right;vertical-align:middle;"><a href="#" onclick="return false;">{img theme='misc/minus.gif' class='v_middle'}{phrase var='core.view_less'}</a></div>
                    </li>
                      {/if}
                </ul>
                {/if}
            </li>
	{/foreach}
	</ul>
</div>
