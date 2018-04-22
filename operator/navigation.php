<?php

namespace raytech\navigation\operator;

use phpbb\db\driver\driver_interface;

/**
 * Description of navigation
 *
 * @author Reaper
 */
class navigation
{

	/** @var \phpbb\db\driver\driver_interface Database Connection Object * */
	protected $db;

	/** @var string Table Prefix * */
	protected $table_prefix;

	public function __construct(driver_interface $db, $table_prefix)
	{
		$this->db			 = $db;
		$this->table_prefix	 = $table_prefix;
	}

	public function load()
	{
		$sql	 = "SELECT * FROM {$this->table_prefix}navigation WHERE level = '0' ORDER BY weight ASC";
		$result	 = $this->db->sql_query($sql);
		$row	 = $this->db->sql_fetchrowset($result);
		foreach ($row as $link)
		{
			$links[] = new \raytech\navigation\entity\navigation($link);
		}
		return $links;
	}

	public function loadByLevel($level)
	{
		$sql	 = "SELECT * FROM {$this->table_prefix}navigation WHERE level = {$level} ORDER BY weight ASC";
		$result	 = $this->db->sql_query($sql);
		$row	 = $this->db->sql_fetchrowset($result);
		foreach ($row as $link)
		{
			$links[] = new \raytech\navigation\entity\navigation($link);
		}
		return $links;
	}

	public function loadByParent($parent)
	{
		$sql	 = "SELECT * FROM {$this->table_prefix}navigation WHERE parent = {$parent} AND level = '0' ORDER BY weight ASC";
		$result	 = $this->db->sql_query($sql);
		$row	 = $this->db->sql_fetchrowset($result);
		foreach ($row as $link)
		{
			$links[] = new \raytech\navigation\entity\navigation($link);
		}
		if(isset($links))
		{	
			return $links;
		}
		return false;
	}
	
	public function loadTopLevel()
	{
		$sql	 = "SELECT * FROM {$this->table_prefix}navigation WHERE parent = '0' AND level = '0' ORDER BY weight ASC";
		$result	 = $this->db->sql_query($sql);
		$row	 = $this->db->sql_fetchrowset($result);
		foreach ($row as $link)
		{
			$links[] = new \raytech\navigation\entity\navigation($link);
		}
		return $links;
	}

	public function loadById($id)
	{
		$sql	 = "SELECT * FROM {$this->table_prefix}navigation WHERE id = {$id}";
		$result	 = $this->db->sql_query($sql);
		$row	 = $this->db->sql_fetchrow($result);
		$link	 = new \raytech\navigation\entity\navigation($row);
		return $link;
	}

	public function loadOrderedByName()
	{
		$sql	 = "SELECT * FROM {$this->table_prefix}navigation WHERE level = '0' ORDER BY name ASC";
		$result	 = $this->db->sql_query($sql);
		$row	 = $this->db->sql_fetchrowset($result);
		foreach ($row as $link)
		{
			$links[] = new \raytech\navigation\entity\navigation($link);
		}
		return $links;
	}

	public function insert($post)
	{
		$sql = "INSERT INTO {$this->table_prefix}navigation (name,parent,weight,url) VALUES ('{$post['name']}','{$post['parent']}','{$post['weight']}','{$post['url']}')";
		$this->db->sql_query($sql);
		return true;
	}

	public function update($post)
	{
		$sql = "UPDATE {$this->table_prefix}navigation SET name = '{$post['name']}',parent = '{$post['parent']}',weight = '{$post['weight']}',url = '{$post['url']}' WHERE id = '{$post['id']}'";
		$this->db->sql_query($sql);
		return true;
	}

	public function delete($id)
	{
		$sql = "DELETE FROM {$this->table_prefix}navigation WHERE id = '{$id}'";
		$this->db->sql_query($sql);
		return true;
	}

}