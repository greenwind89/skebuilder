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

function [skebuilder:module_name]_install301() {

	$oDatabase = Phpfox::getLib('database') ;

	
	$oDatabase->query("
	CREATE TABLE IF NOT EXISTS `". Phpfox::getT('[skebuilder:module_name]_category') ."` (
			`category_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
			 `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
			 `is_active` tinyint(1) NOT NULL DEFAULT '0',
			 `name` varchar(255) NOT NULL,
			 `time_stamp` int(10) unsigned NOT NULL DEFAULT '0',
			 `used` int(10) unsigned NOT NULL DEFAULT '0',
			 `ordering` int(11) unsigned NOT NULL DEFAULT '0',
			 PRIMARY KEY (`category_id`),
			 KEY `parent_id` (`parent_id`,`is_active`),
			 KEY `is_active` (`is_active`)
		)  AUTO_INCREMENT=1 ;
	");


	//fundraising_category
	$oDatabase->query("
	CREATE TABLE IF NOT EXISTS `". Phpfox::getT('[skebuilder:module_name]_category_data') ."` (
			`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`category_id` int(10) unsigned NOT NULL ,
			`[skebuilder:item_name]_id` int(10) unsigned NOT NULL ,
			PRIMARY KEY (`id`),
			KEY `campaign_category` (`category_id`,`[skebuilder:item_name]_id`),
			KEY `category_id` (`category_id`)
		)  AUTO_INCREMENT=1 ;
	");

	 $oDatabase->query("INSERT IGNORE INTO `". Phpfox::getT('[skebuilder:module_name]_category') ."` (`category_id`, `name`, `parent_id`, `time_stamp`, `used`, `is_active`) VALUES
(11, 'Sustainable Food', 0, 1328241168, 0, 1),
(10, 'Immigrant Rights', 0, 1328241173, 0, 1),
(9, 'Human Trafficking', 0, 1328241176, 0, 1),
(8, 'Human Rights', 0, 1328241180, 0, 1),
(7, 'Health', 0, 1328241185, 0, 1),
(6, 'Gay Rights', 0, 1328241187, 0, 1),
(5, 'Environment', 0, 1328241191, 0, 1),
(4, 'Education', 0, 1328241194, 0, 1),
(3, 'Economic Justice', 0, 1328241197, 0, 1),
(2, 'Criminal Justice', 0, 1328241200, 0, 1),
(1, 'Animals', 0, 1328241203, 0, 1);");
	

}

[skebuilder:module_name]_install301();