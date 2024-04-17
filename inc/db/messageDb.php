<?php
// namespace db;

include_once "mysql.php";

class MessageDb extends Mysql
{
	private $db = null;

	function __construct()
	{
		$this->db = new Mysql();
	}

	function getByUserId($user, $limit = 10)
	{
		$limit = $limit + 0;
		$sql = "select 
				m.id mid, 
				m.created_at created, 
				m.sent_at sent, 
				m.viewed_at viewed, 
				m.read_at `read`, 
				m.content content,
				u.id uid,
				u.name name,
				u.hash hash

			from message m
			left join user u on m.ufrom = u.id

			where m.deleted_at is null
			and m.read_at is null # unread

			# User
				#and m.uto = 1 # when the admin takes all users (1 = admin)
				#and m.ufrom = 2 # when the admin takes a specific user (2 = me)
			and (m.uto = ? and m.ufrom = 1) # when the user gets messages from the admin

			# Choosing a period
			and m.created_at >= '2024-04-15 20:47:21'

			# Limiting to N messages
			limit $limit";

		return $this->db->query($sql, [$user]);
	}

	function getToAdm($date = '', $limit = 10) 
	{
		$date = $date === '' ? '' : "and m.created_at >= $date"; // Sample: '2024-04-15 20:47:21'
		$limit = $limit + 0;
		$sql = "select 
				m.id mid, 
				m.created_at created, 
				m.sent_at sent, 
				m.viewed_at viewed, 
				m.read_at `read`, 
				m.content content,
				u.id uid,
				u.name name,
				u.hash hash

			from message m
			left join user u on m.ufrom = u.id

			where m.deleted_at is null
			and m.read_at is null # unread

			# User
			and m.uto = 1 # when the admin takes all users (1 = admin)

			# Choosing a period
			$date

			# Limiting to N messages
			limit $limit";

		return $this->db->query($sql);
	}
}