<?php

class Tier1 extends Common
{

    protected static $table_name = "menu_tier1";

    protected static $db_fields = array(
        'id',
        't1_id',
        'menu_id',
        'name',
    	't1_path',
        't1_url',
        't1_order',
        't1_visible',
        't1_security',
        't1_clearance'
    );

    public $id;

    public $t1_id;

    public $menu_id;

    public $name;
    
    public $t1_path;

    public $t1_url;

    public $t1_order;

    public $t1_visible;

    public $t1_security;

    public $t1_clearance;

    public static function get_all_submenu_by_menu_id($id = '')
    {
        if (empty($id)) {
            return false;
        }
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE menu_id = '{$id}' ";
        return self::find_by_sql($sql);
    }

    public static function get_submenu_by_id($id = '')
    {
        if (empty($id)) {
            return false;
        }
        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE t1_id = '{$id}' ";
        $sql .= "LIMIT 1";
        $result = self::find_by_sql($sql);
        return ($result) ? array_shift($result) : false;
    }

    public static function generate_table_and_data()
    {
        $obj = new self();
        if ($obj->create_table()) {
            $obj->load_data();
            return "Tier1 table was created and populated";
        }
    }

    private function create_table()
    {
        global $base;
        $sql = "CREATE TABLE IF NOT EXISTS menu_tier1 ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "t1_id varbinary(12) NOT NULL, ";
        $sql .= "menu_id varbinary(12) NOT NULL, ";
        $sql .= "name varchar(20) NOT NULL, ";
        $sql .= "t1_url varchar(75) DEFAULT NULL, ";
        $sql .= "t1_order int(2) NOT NULL DEFAULT '99', ";
        $sql .= "t1_visible tinyint(1) NOT NULL DEFAULT '0', ";
        $sql .= "t1_security int(1) NOT NULL DEFAULT '9', ";
        $sql .= "t1_clearance int(1) NOT NULL DEFAULT '9', ";
        $sql .= "PRIMARY KEY (t1_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "KEY menu (menu_id, t1_order), ";
        $sql .= "KEY name (name, t1_order), ";
        $sql .= "KEY security (t1_security, t1_clearance, t1_order) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        return $base->query($sql);
    }

    private function load_data()
    {
        global $base;
        $sql = 'INSERT IGNORE INTO menu_tier1 (id, t1_id, menu_id, name, t1_url, t1_order, t1_visible, t1_security, t1_clearance) VALUES ';
        $sql .= '(2, 0x6349714b314c654156796530, 0x34323938766d30397667656d, "Add User", "add_user.php", 0, 1, 0, 0), ';
        $sql .= '(1, 0x7164343141356e4c74763130, 0x633239386866723338683872, "Add / Edit Menu", "add_menu.php", 0, 1, 0, 0)';
        $base->query($sql);
    }
}

?>
