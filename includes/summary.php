<?php
class Summary extends Common {
    protected static $table_name = "summary";
    protected static $db_fields = array('id', 'sum_id', 'user_id', 'descript', 'last_update', 'visible', 'sorder');
    
    public $id;
    
    public $sum_id;
    
    public $user_id;
    
    public $descript;
    
    public $last_update;
    
    public $visible;
    
    public $sorder;
    
    public static function get_all_summary_by_user_id($id='') {
        if (has_presence($id)) {
            $sql  = "SELECT * FROM " . self::$table_name . " ";
            $sql .= "WHERE user_id = '{$id}' ";
            $sql .= "ORDER BY sorder ";
            return self::find_by_sql($sql);
        }
        return false;
    }
    
    public static function get_summary_by_id($id='') {
        if (has_presence($id)) {
            $sql  = "SELECT * FROM " . self::$table_name . " ";
            $sql .= "WHERE sum_id = '{$id}' ";
            $sql .= "LIMIT 1";
            $result = self::find_by_sql($sql);
            return ($result) ? array_shift($result) : false;
        }
        return false;
    }
    
    public static function get_all_summary_by_user_id_visible($id='') {
        if (has_presence($id)) {
            $sql  = "SELECT * FROM " . self::$table_name . " ";
            $sql .= "WHERE user_id = '{$id}' ";
            $sql .= "AND visible ";
            $sql .= "ORDER BY sorder";
            return self::find_by_sql($sql);
        }
        return false;
    }
}