<?php

namespace raytech\navigation\controller;

use phpbb\user;
use phpbb\path_helper;
use phpbb\controller\helper;
use phpbb\template\template;
use phpbb\extension\manager;
use raytech\navigation\operator\navigation;
use Symfony\Component\DependencyInjection\ContainerInterface;

class main
{

	/** @var phpbb\template\template  */
	protected $template;

	/** @var Symfony\Component\DependencyInjection\ContainerInterface  */
	protected $container;

	/** @var raytech\navigation\operator\navigation  */
	protected $operator;

	/** @var \phpbb\user User Class  */
	protected $user;
	
	/** @var \phpbb\path_helper */
	protected $path_helper;
	
	/** @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\extension\manager */
	protected $manager;
	
	public function __construct(manager $manager, user $user, helper $helper, path_helper $path_helper, template $template, ContainerInterface $container, navigation $operator)
	{
		$this->template	 = $template;
		$this->container = $container;
		$this->operator	 = $operator;
		$this->user		 = $user;
		$this->helper	 = $helper;
		$this->path_helper = $path_helper;
		$this->manager	= $manager;
	}

	public function get_data()
	{
		$this->user->add_lang('common');
		$links		 = $this->operator->loadTopLevel();
		$i = 0;
		$data = [];
		foreach ($links as $link)
		{
			$i++;
			$data[$i] = $link->toArray();
			$childrens = $this->operator->loadByParent($link->getId());
			$c = 0;
			if ($childrens !== false)
			{
				foreach ($childrens as $child)
				{
					$c++;
					$data[$i]['children'][$c] = $child->toArray();
					$second_childrens = $this->operator->loadByParent($child->getId());
					$s = 0;
					if ($second_childrens !== false)
					{
						foreach ($second_childrens as $second_child)
						{
							$s++;
							$data[$i]['children'][$c]['children'][$s] = $second_child->toArray();
						}	
					}	
				}	
			}	
		}
		//$render $this->
		return $data;
	}

	
}