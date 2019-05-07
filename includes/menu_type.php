<?php
class Menu_Type extends Common {
    protected static $table_name = 'menu_type';
    protected static $db_fields = array('id', 'type_id', 'm_type', 'visible', 'type_order', 'security', 'clearance');
    
    public $id;
    
    public $type_id;
    
    public $m_type;
    
    public $visible;
    
    public $type_order;
    
    public $security;
    
    public $clearance;
    
    public static function get_by_type($menu_type, $sec) {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE m_type = '{$menu_type}' ";
        $sql .= "AND $sec >= security ";
        $result = self::find_by_sql($sql);
        return ($result) ? array_shift($result) : false; 
    }
    
    public static function get_all_type_by_order() {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY type_order";
        return self::find_by_sql($sql);
    }
    
    public static function get_by_type_id($id='') {
        if (empty($id)) {
            return false;
        }
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE type_id = '{$id}' ";
        $sql .= "LIMIT 1";
        $result = self::find_by_sql($sql);
        return ($result) ? array_shift($result) : false;
    }
    
    public static function generate_table_and_data() {
        $obj = new self;
        if ($obj->create_table()) {
            $obj->load_data();
            return "Menu_Type table was created and populated";
        }
    }
    
    private function create_table() {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS menu_type ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "type_id varbinary(12) NOT NULL, ";
        $sql .= "m_type varchar(35) NOT NULL, ";
        $sql .= "visible tinyint(1) NOT NULL, ";
        $sql .= "type_order int(2) NOT NULL, ";
        $sql .= "security int(1) NOT NULL, ";
        $sql .= "clearance int(1) NOT NULL, ";
        $sql .= "PRIMARY KEY (type_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "UNIQUE KEY m_type (m_type), ";
        $sql .= "KEY type_order (type_order) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        return $base->query($sql);
    }
    
    private function load_data() {
        global $base;
        $sql  = 'INSERT IGNORE INTO menu_type (id, type_id, m_type, visible, type_order, security, clearance) VALUES ';
        $sql .= '(5, 0x323158703234646a78337337, "R&amp;eacute;sum&amp;eacute;", 1, 4, 9, 9), ';
        $sql .= '(1, 0x373430675842353649354a56, "JCS", 1, 0, 9, 9), ';
        $sql .= '(3, 0x583667396346337a76373767, "VMAS", 1, 2, 9, 9), ';
        $sql .= '(4, 0x595544314b7275555970376e, "CLAD", 1, 3, 9, 9), ';
        $sql .= '(2, 0x624d397977544f3341387035, "Tracker", 1, 1, 9, 9)';
        $base->query($sql);
    }
}


?>
