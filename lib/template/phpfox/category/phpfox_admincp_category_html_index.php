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
 ?>
 
<div id="js_menu_drop_down" style="display:none;">
	<div class="link_menu dropContent" style="display:block;">
		<ul>
			<li><a href="#" onclick="return $Core.[skebuilder:module_name].action(this, 'edit');">{phrase var='[skebuilder:module_name].edit'}</a></li>
			<li><a href="#" onclick="return $Core.[skebuilder:module_name].action(this, 'delete');">{phrase var='[skebuilder:module_name].delete'}</a></li>
		</ul>
	</div>
</div>
<div class="table_header">
	{phrase var='[skebuilder:module_name].categories'}
</div>
<form method="post" action="{url link='admincp.[skebuilder:module_name].category'}">
	<div class="table">
		<div class="sortable">
			{$sCategories}			
		</div>
	</div>
	<div class="table_clear">
		<input type="submit" value="{phrase var='[skebuilder:module_name].update_order'}" class="button" />
	</div>
</form>