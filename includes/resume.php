<?php

class Resume extends Common
{

	protected static $table_name = "resume";

	protected static $db_fields = array(
		'id',
		'r_id',
		'user_id',
		'name',
		'position',
		'visible'
	);

	public $id;

	public $r_id;

	public $user_id;

	public $name;

	public $position;

	public $visible;

	public static function find_by_id($id)
	{
		$sql = "SELECT * FROM " . self::$table_name . " ";
		$sql .= "WHERE r_id = '{$id}' ";
		$sql .= "LIMIT 1";
		$results = self::find_by_sql($sql);
		return array_shift($results);
	}

	public static function get_all_resume_by_user_id($user_id)
	{
		$sql = "SELECT * FROM " . self::$table_name . " ";
		$sql .= "WHERE user_id = '{$user_id}' ";
		$sql .= "ORDER BY position ";
		return self::find_by_sql($sql);
	}

	public static function get_all_visible_resume_by_user_id($user_id)
	{
		$sql = "SELECT * FROM " . self::$table_name . " ";
		$sql .= "WHERE user_id = '{$user_id}' ";
		$sql .= "AND visible ";
		$sql .= "ORDER BY position ";
		return self::find_by_sql($sql);
	}

	private function generate_table()
	{
		global $base;
		$sql = "CREATE TABLE IF NOT EXISTS " . self::$table_name . "( ";
		$sql .= "id int(11) not null auto_increment, ";
		$sql .= "r_id varbinary(12) not null, ";
		$sql .= "user_id varbinary(12) not null, ";
		$sql .= "name varchar(35) not null, ";
		$sql .= "position int(2) not null, ";
		$sql .= "visible tinyint(1) not null default 0";
		$sql .= "primary key (r_id), ";
		$sql .= "unique index id (id), ";
		$sql .= "index name (name), ";
		$sql .= "foreign key (user_id) references user (user_id)) ";
		$sql .= "engine=InnoDB default charset=utf8";
		$base->query($sql);
	}

	public static function call_generate_table()
	{
		$obj = new self();
		$obj->generate_table();
	}
}
