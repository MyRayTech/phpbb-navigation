<?php

/**
 *
 * navigation extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2015 RayTech <https://www.myraytech.net>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */
/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge(
		$lang, array(
	'ACP_NAVIGATION'					 => 'Navigation',
	'ACP_NAVIGATION_SETTINGS'			 => 'Settings',
	'ACP_NAVIGATION_SETTINGS_TITLE'		 => 'Navigation Settings',
	'ACP_NAVIGATION_LIST'				 => 'Manage Main Navigation',
	'ACP_NAVIGATION_LIST_TITLE'			 => 'Navigation List',
	'ACP_NAVIGATION_TITLE'				 => 'Navigation Administration',
	'ACP_NAVIGATION_LIST_TITLE_EXPLAIN'	 => 'You can make your own navigation for the top menu using this administration.<br /> You may now use this extension fully if you have ideas or bugs please put them in the bugs section of the forums.',
	'ACP_NAVIGATION_ADD_TITLE_EXPLAIN'	 => 'To make a link within the site make sure it\'s has a "/" in front unless external link.',
	'ACP_NAVIGATION_NAME'				 => 'Display name',
	'ACP_NAVIGATION_URL'				 => 'Address (URL)',
	'ACP_NAVIGATION_PARENT'				 => 'Menu Parent',
	'ACP_NAVIGATION_WEIGHT'				 => 'Order',
	'ACP_NAVIGATION_ADDCAT'				 => 'Add a link',
	'ACP_NAVIGATION_DELETE_MSG_CONFIRM'	 => 'Are you sure you want to delete this link?',
		)
);