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
 ?>
 
<div id="js_menu_drop_down" style="display:none;">
	<div class="link_menu dropContent" style="display:block;">
		<ul>
			<li><a href="#" onclick="return $Core.jobposting.action(this, 'edit');">{phrase var='jobposting.edit'}</a></li>
			<li><a href="#" onclick="return $Core.jobposting.action(this, 'delete');">{phrase var='jobposting.delete'}</a></li>
		</ul>
	</div>
</div>
<div class="table_header">
	{phrase var='jobposting.categories'}
</div>
<form method="post" action="{url link='admincp.jobposting.category'}">
	<div class="table">
		<div class="sortable">
			{$sCategories}			
		</div>
	</div>
	<div class="table_clear">
		<input type="submit" value="{phrase var='jobposting.update_order'}" class="button" />
	</div>
</form>