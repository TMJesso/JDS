<?php
class Login extends Common {
    protected static $table_name = "user_logins";
    protected static $db_fields = array('id', 'login_id', 'user_id', 'descript', 'url');
    
    public $id;
    
    public $login_id;
    
    public $user_id;
    
    public $descript;
    
    public $url;
    
    public static function get_all_logins($user_id='', $alpha=true) {
        
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE user_id = '{$user_id}' ";
        if ($alpha) {
            $sql .= "ORDER BY descript";
        } else {
            $sql .= "ORDER BY id";
        }
        return self::find_by_sql($sql);
    }
    
    public static function get_login_by_id($id='') {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE login_id = '{$id}' ";
        $sql .= "LIMIT 1";
        $result = self::find_by_sql($sql);
        return ($result) ? array_shift($result) : false;
    }
    
    public static function get_login_by_login_id($id=0) {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE id = {$id} ";
        $sql .= "LIMIT 1";
        $result = self::find_by_sql($sql);
        return ($result) ? array_shift($result) : false;
    }
    
    public static function howmany() {
        global $base;
        $sql = "SELECT COUNT(*) FROM " . self::$table_name;
        $results = $base->query($sql);
        if ($results) {
            $row = $base->fetch_array($results);
        } else {
            return false;
        }
        if ($row) {
            return array_shift($row);
        } else {
            return false;
        }
    }
    
    
    public static function generate_table_and_data() {
        global $base;
        $obj = new self;
        $text = "";
        if ($obj->create_table()) {
            $text .= "Table " . self::$table_name . " created";
            $sql = "SELECT COUNT(*) FROM " . self::$table_name;
            $results = $base->query($sql);
            $row = $base->fetch_array($results);
            $num = array_shift($row);
            if ($num <= 0) {
                if ($obj->load_data()) {
                    $text .= " and populated!";
                }
            } else {
                $text .= "!";
            }
        }
        return $text;
    }
    
    private function create_table() {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS " . self::$table_name . " ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "login_id varbinary(12) NOT NULL, ";
        $sql .= "user_id varbinary(12) NOT NULL, ";
        $sql .= "descript varchar(75) NOT NULL, ";
        $sql .= "url varchar(150) NOT NULL, ";
        $sql .= "PRIMARY KEY (login_id), ";
        $sql .= "UNIQUE INDEX id (id), ";
        $sql .= "FOREIGN KEY (user_id) REFERENCES user (user_id)) ";
        $sql .= "ENGINE=InnoDB DEFAULT CHARSET=utf8";
        return $base->query($sql);
    }
    
    private function load_data() {
        global $base;
        return false;
    }
}

class UnPw extends Common {
    protected static $table_name = "user_unpw";
    protected static $db_fields = array('id', 'unpw_id', 'login_id', 'user_pass');
    
    public $id;
    
    public $unpw_id;
    
    public $login_id;
    
    /**
     * Username (0) or Password (1) (False or True)
     */
    public $user_pass;
    
    public static function get_all_by_login_id($id) {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE login_id = '{$id}' ";
        $sql .= "ORDER BY user_pass DESC";
        return self::find_by_sql($sql);
    }
    
    public static function get_unpw_by_id($id) {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE unpw_id = '{$id}' ";
        $sql .= "LIMIT 1";
        $result = self::find_by_sql($sql);
        return ($result) ? array_shift($result) : false;
    }
    public static function generate_table_and_data() {
        global $base;
        $obj = new self;
        $text = "";
        if ($obj->create_table()) {
            $text .= "Table " . self::$table_name . " created";
            $sql = "SELECT COUNT(*) FROM " . self::$table_name;
            $results = $base->query($sql);
            $row = $base->fetch_array($results);
            $num = array_shift($row);
            if ($num <= 0) {
                if ($obj->load_data()) {
                    $text .= " and populated!";
                }
            } else {
                $text .= "!";
            }
        }
        return $text;
    }
    
    private function create_table() {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS " . self::$table_name . " ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "unpw_id varbinary(12) NOT NULL, ";
        $sql .= "login_id varbinary(12) NOT NULL, ";
        $sql .= "user_pass tinyint(1) NOT NULL DEFAULT 0, ";
        $sql .= "PRIMARY KEY (unpw_id), ";
        $sql .= "UNIQUE INDEX id (id), ";
        $sql .= "INDEX login_id (login_id)) ";
        $sql .= "ENGINE=InnoDB DEFAULT CHARSET=utf8";
        return $base->query($sql);
    }
    
    private function load_data() {
        global $base;
        return false;
    }
}

class Codes extends Common {
    protected static $table_name = "login_codes";
    protected static $db_fields = array('id', 'codes_id', 'unpw_id', 'multiplier', 'codex', 'weight', 'slt', 'code_order', 'np');
    
    public $id;
    
    public $codes_id;
    
    public $unpw_id;
    
    /**
     * only x should be placed in here
     * 
     * @var mixed
     */
    public $multiplier;
    
    /**
     * only y should be placed in here
     * 
     * @var mixed
     */
    public $codex;
    
    /**
     * the hex value reversed of code weight 
     * 
     * @var mixed
     */
    public $weight;
    
    /**
     * salt value
     * @var string
     */
    public $slt;
    
    public $code_order;
    
    /** np (New Password)
     * 
     * Generating new paswsword and if this is true
     * then use the new function to decode it
     * 
     * @var Boolean
     * 
     */
    public $np;
    
    public static function get_codes_by_id($id='') {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE unpw_id = '{$id}' ";
        $sql .= "ORDER BY code_order ";
        return self::find_by_sql($sql);
    }
    
    public static function delete_all_codes_for_unpw_id($id='') {
        global $base;
        $sql  = "DELETE FROM " . self::$table_name . " ";
        $sql .= "WHERE unpw_id = '{$id}'";
        return $base->query($sql);
    }
    
    public function gen_salt($length=22) {
        $this->slt = substr(md5(uniqid(mt_rand(), true)), 0, $length);
    }
    
    public static function generate_table_and_data() {
        global $base;
        $obj = new self;
        $text = "";
        if ($obj->create_table()) {
            $text .= "Table " . self::$table_name . " created";
            $sql = "SELECT COUNT(*) FROM " . self::$table_name;
            $results = $base->query($sql);
            $row = $base->fetch_array($results);
            $num = array_shift($row);
            if ($num <= 0) {
                if ($obj->load_data()) {
                    $text .= " and populated!";
                }
            } else {
                $text .= "!";
            }
        }
        return $text;
    }
    
    private function create_table() {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS " . self::$table_name . " ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "codes_id varbinary(12) NOT NULL, ";
        $sql .= "unpw_id varbinary(12) NOT NULL, ";
        $sql .= "multiplier varbinary(12) NOT NULL, ";
        $sql .= "codex varbinary(12) NOT NULL, ";
        $sql .= "weight varbinary(12) NOT NULL, ";
        $sql .= "slt varbinary(22) NOT NULL, ";
        $sql .= "code_order int(6) NOT NULL DEFAULT 999999, ";
        $sql .= "PRIMARY KEY (codes_id), ";
        $sql .= "UNIQUE INDEX id (id), ";
        $sql .= "INDEX unpw_id (unpw_id), ";
        $sql .= "INDEX code_order (unpw_id, code_order)) ";
        $sql .= "ENGINE=InnoDB DEFAULT CHARSET=utf8";
        return $base->query($sql);
    }
    
    private function load_data() {
        global $base;
        return false;
    }
}

class CodeB extends Common {
    protected static $table_name = "codes_back";
    protected static $db_fields = array('id', 'codes_id', 'unpw_id', 'multiplier', 'codex', 'weight', 'slt', 'code_order', 'np');
    
    public $id;
    
    public $codes_id;
    
    public $unpw_id;
    
    /**
     * only x should be placed in here
     *
     * @var mixed
     */
    public $multiplier;
    
    /**
     * only y should be placed in here
     *
     * @var mixed
     */
    public $codex;
    
    /**
     * the hex value reversed of code weight
     *
     * @var mixed
     */
    public $weight;
    
    /**
     * salt value
     * @var string
     */
    public $slt;
    
    public $code_order;

    public $np;

    public static function get_all_codes_by_id($id) {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE unpw_id = '{$id}' ";
        $sql .= "ORDER BY unpw_id, code_order";
        return self::find_by_sql($sql);
    }
    
    public static function copy_codes_by_id($id) {
        global $base;
        $sql  = "INSERT IGNORE INTO " . self::$table_name . " ";
        $sql .= "SELECT * FROM login_codes ";
        $sql .= "WHERE unpw_id = '{$id}' ";
        if ($base->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}


?>
