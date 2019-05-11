<?php

class Tier2 extends Common
{

    protected static $table_name = "menu_tier2";

    protected static $db_fields = array(
        'id',
        't2_id',
        't1_id',
        'name',
    	't2_path',
        't2_url',
        't2_order',
        't2_visible',
        't2_security',
        't2_clearance'
    );

    public $id;

    public $t2_id;

    public $t1_id;

    public $name;
    
    public $t2_path;

    public $t2_url;

    public $t2_order;

    public $t2_visible;

    public $t2_security;

    public $t2_clearance;

    public static function get_menu_by_id($id = '')
    {
        if (empty($id)) {
            return false;
        }
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE t2_id = '{$id}' ";
        $sql .= "LIMIT 1";
        $result = self::find_by_sql($sql);
        return ($result) ? array_shift($result) : false;
    }

    public static function get_all_menu_by_tier1_id($id = '')
    {
        if (empty($id)) {
            return false;
        }
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE t1_id = '{$id}' ";
        $sql .= "ORDER BY t2_order";
        return self::find_by_sql($sql);
    }

    public static function get_menu_by_name($menu_name = '')
    {
        if (empty($menu_name)) {
            return false;
        }
    }

    public static function generate_table_and_data()
    {
        $obj = new self();
        if ($obj->create_table()) {
            $obj->load_data();
            return "Tier2 table was created and populated";
        }
    }

    private function create_table()
    {
        global $base;
        $sql = "CREATE TABLE IF NOT EXISTS menu_tier2 ( ";
        $sql .= "id int(11) NOT NULL DEFAULT 0, ";
        $sql .= "t2_id varbinary(12) NOT NULL, ";
        $sql .= "t1_id varbinary(12) NOT NULL, ";
        $sql .= "name varchar(35) NOT NULL, ";
        $sql .= "t2_url varchar(75) NOT NULL, ";
        $sql .= "t2_order int(2) NOT NULL DEFAULT 0, ";
        $sql .= "t2_visible tinyint(1) NOT NULL DEFAULT 0, ";
        $sql .= "t2_security int(1) NOT NULL DEFAULT 9, ";
        $sql .= "t2_clearance int(1) NOT NULL DEFAULT 9, ";
        $sql .= "PRIMARY KEY (t2_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "KEY name (name), ";
        $sql .= "KEY t1_id (t1_id), ";
        $sql .= "KEY t2_order (t1_id, t2_order), ";
        $sql .= "FOREIGN KEY (t1_id) REFERENCES menu_tier1 (t1_id) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        return $base->query($sql);
    }

    private function load_data()
    {
        //global $base;
    }
}