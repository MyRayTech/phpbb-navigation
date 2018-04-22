<?php

/**
 *
 * Member Application extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2015 RayTech LLC <https://www.myraytech.net>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace raytech\navigation\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use raytech\navigation\controller\main;
use phpbb\controller\helper;
use phpbb\extension\manager;
use phpbb\path_helper;
use phpbb\template\template;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{

	/** @var \raytech\navigation\controller\main * */
	protected $controller;

	/** @var \phpbb\extension\manager Extension Manager * */
	protected $ext_manager;

	/** @var \phpbb\controller\helper Controller Helper * */
	protected $helper;

	/** @var \phpbb\path_helper  Path Helper * */
	protected $path_helper;

	/** @var \phpbb\template\template Templating Object * */
	protected $template;

	public function __construct(manager $ext_manager, path_helper $path_helper, helper $helper, template $template, main $controller)
	{
		$this->ext_manager	 = $ext_manager;
		$this->path_helper	 = $path_helper;
		$this->helper		 = $helper;
		$this->controller	 = $controller;
		$this->template		 = $template;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.page_header' => 'page_header',
			'core.page_footer' => 'page_footer',
		];
	}

	public function page_header()
	{
		//$this->user->add_lang('common');
		$data = $this->controller->get_data();

		foreach ($data as $top_level)
		{
			$this->template->assign_block_vars('nav_menu', [
				'URL'	 => $top_level['url'],
				'NAME'	 => $top_level['name'],
			]);
			if (isset($top_level['children']))
			{
				$this->setChildren($top_level['children']);
			}
		}
	}

	public function setChildren($data)
	{
		foreach ($data as $child)
		{
			
			$this->template->assign_var('nav_child', true);
			$this->template->assign_block_vars('nav_menu.nav_childs', [
				'URL'	 => $child['url'],
				'NAME'	 => $child['name'],
			]);
			if(isset($child['children']))
			{
				$this->getSecondChildren($child['children']);
			}
		}
	}

	public function getSecondChildren($data)
	{
		foreach ($data as $child)
		{
			
			$this->template->assign_var('nav_sub_child', true);
			$this->template->assign_block_vars('nav_menu.nav_childs.nav_sub_childs', [
				'URL'	 => $child['url'],
				'NAME'	 => $child['name'],
			]);
			
		}
	}

	public function page_footer()
	{
		$this->template->assign_vars([
			'L_CONTACT_US' => 'Contact us',
			'U_CONTACT_US' => '/member?mode=contactadmin',
			'L_THE_TEAM'	=> 'The Leaders',
			'U_TEAM'	=> '/the-leaders',
			'L_MEMBERLIST' => 'Members',
			'U_MEMBERLIST'	=> '/member',
			''
		]);
		
	}
}