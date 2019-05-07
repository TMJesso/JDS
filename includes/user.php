<?php
class User extends Common {
    protected static $table_name = "user";
    protected static $db_fields = array('id', 'user_id', 'username', 'passcode', 'changepass', 'security', 'clearance');
    
    public $id;
    
    public $user_id;
    
    public $username;
    
    public $passcode;
    
    public $changepass;
    
    public $security;
    
    public $clearance;
    
    public static function get_all_users() {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "ORDER BY username, security, clearance";
        return self::find_by_sql($sql);
    }
    
    public static function get_user_by_user_id($id='') {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE user_id = '{$id}' ";
        $sql .= "LIMIT 1";
        $result = self::find_by_sql($sql);
        return ($result) ? array_shift($result) : false;
    }
    
    public static function get_user_by_username($username='') {
        if (empty($username)) {
            return false;
        }
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .= "LIMIT 1";
        $result = self::find_by_sql($sql);
        return array_shift($result);
    }
    
    public static function generate_table_and_data() {
        $obj = new self;
        if ($obj->create_table()) {
           $obj->load_data();
           return "User table was created and populated";
        }
    }
    
    private function create_table() {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS user ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "user_id varbinary(12) NOT NULL, ";
        $sql .= "username varbinary(50) NOT NULL, ";
        $sql .= "passcode varchar(72) NOT NULL, ";
        $sql .= "changepass tinyint(1) NOT NULL DEFAULT 0, ";
        $sql .= "security int(1) NOT NULL DEFAULT 9, ";
        $sql .= "clearance int(1) NOT NULL DEFAULT 9, ";
        $sql .= "PRIMARY KEY (user_id), ";
        $sql .= "UNIQUE INDEX id (id), ";
        $sql .= "UNIQUE INDEX username (username), ";
        $sql .= "INDEX security (security), ";
        $sql .= "INDEX clearance (clearance)) ";
        $sql .= "ENGINE=InnoDB DEFAULT CHARSET=utf8";
        return $base->query($sql);
    }
    
    private function load_data() {
        global $base;
        $sql  = 'INSERT IGNORE INTO user (id, user_id, username, passcode, changepass, security, clearance) VALUES ';
        $sql .= '(1, 0x5a584b34514255344d5a3836, 0x544a41646d696e, "$2y$10$h.JBwWmtCO0xzJ1bVlsjTeWpBLDqc.7xZPwcHJd/Y//Fakj3/lHqG", 0, 0, 0), ';
        $sql .= '(2, 0x645659363452717669544934, 0x5075626c6963, "$2y$10$0n0/W0UUCj3qSVI5eEYdhOR7n2B0KRq3O/FqLy9FwjW0RJMHH39e.", 0, 9, 9);';
        $base->query($sql);
    }
}

