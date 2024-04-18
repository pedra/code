<?php
include_once "mysql.php";

class UserDb extends Mysql
{
	private $db = null;

	function __construct()
	{
		$this->db = new Mysql();
	}

	function getById($id = null, $limit = 10)
	{
		$user = $id == null ? "" : "and u.id = ?";
		$limit = $limit + 0;
		$sql = "select 
				u.id uid,
				u.name name,
				u.hash hash,
				(select count(m.id) 
					from message m 
					where m.deleted_at is null
					and m.read_at is null # unread
					and m.uto = u.id
				) msg

			from user u
			where u.deleted_at is null
			$user
			group by u.id
			limit $limit";

		return  $this->db->query($sql, $id == null ? null : [$id]);
	}

	function getAll() 
	{
		return $this->getById(null, -1);
	}

	function getByHash($hash, $limit = 10)
	{
		$limit = $limit + 0;
		$sql = "select
				u.id uid,
				u.name name,
				u.hash hash,
				(select count(m.id)
					from message m
					where m.deleted_at is null
					and m.read_at is null # unread
					and m.uto = u.id
				) msg

			from user u
			where u.deleted_at is null
			and u.hash = ?
			group by u.id
			limit $limit";

		return  $this->db->query($sql, [$hash]);
	}
}