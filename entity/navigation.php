<?php

namespace raytech\navigation\entity;



/**
 * Description of navigation
 *
 * @author Reaper
 */
class navigation
{
	protected $id;
	protected $name;
	protected $parent;
	protected $weight;
	protected $url;
	
	
	public function __construct($link)
	{
		$this->id = $link['id'];
		$this->name = $link['name'];
		$this->parent = $link['parent'];
		$this->weight = $link['weight'];
		$this->url = $link['url'];
	}
	
	public function toArray()
	{
		return ['id' => $this->id,'name' => $this->name,'parent' => $this->parent,'weight' => $this->weight,'url'	=> $this->url];
	}
	
	public function getId()
	{
		return $this->id;
	}
	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}
	public function getParent()
	{
		return $this->parent;
	}
	public function setParent($parent)
	{
		$this->parent = $parent;
		return $this;
	}
	public function getWeight()
	{
		return $this->weight;
	}
	public function setWeight($weight)
	{
		$this->weight = $weight;
		return $this;
	}
	public function getUrl()
	{
		return $this->url;
	}
	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}
}