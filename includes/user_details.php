<?php
class User_Detail extends Common {
    protected static $table_name = 'user_details';
    protected static $db_fields = array('id', 'detail_id', 'user_id', 'fname', 'lname', 'address1', 'address2', 'city', 'state', 'zip', 'email', 'phone', 'phone1', 'entity');
    
    public $id;
    
    public $detail_id;
    
    public $user_id;
    
    public $fname;
    
    public $lname;
    
    public $address1;
    
    public $address2;
    
    public $city;
    
    public $state;
    
    public $zip;
    
    public $email;
    
    public $phone;
    
    public $phone1;
    
    public $entity;
    
    
    public static function get_details_by_user_id($id='') {
        $sql  = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE user_id = '{$id}'";
        $result = self::find_by_sql($sql);
        return ($result) ? array_shift($result) : false;
    }
    
    public static function generate_table_and_data() {
        $obj = new self();
        if ($obj->create_table()) {
            $obj->load_data();
            return "User_Type table was created and populated";
        }
    }
    
    public function get_fullname() {
        return $this->fname . " " . $this->lname;
    }
    
    public function get_reverse_name() {
        return $this->lname . ", " . $this->fname;
    }
    
    private function create_table() {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS user_details ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "detail_id varbinary(12) NOT NULL, ";
        $sql .= "user_id varbinary(12) NOT NULL, ";
        $sql .= "fname varchar(25) NOT NULL, ";
        $sql .= "lname varchar(25) NOT NULL, ";
        $sql .= "address1 varchar(45) DEFAULT NULL, ";
        $sql .= "address2 varchar(45) DEFAULT NULL, ";
        $sql .= "city varchar(30) DEFAULT NULL, ";
        $sql .= "state varchar(2) NOT NULL, ";
        $sql .= "zip varchar(10) NOT NULL, ";
        $sql .= "email varchar(50) NOT NULL, ";
        $sql .= "phone varchar(14) DEFAULT NULL, ";
        $sql .= "phone1 varchar(14) DEFAULT NULL, ";
        $sql .= "entitiy varchar(75) DEFAULT NULL, ";
        $sql .= "PRIMARY KEY (detail_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "UNIQUE KEY user_id (user_id), ";
        $sql .= "KEY name (fname,lname), ";
        $sql .= "KEY rev_name (lname,fname), ";
        $sql .= "KEY address (state,city,address1), ";
        $sql .= "FOREIGN KEY (user_id) REFERENCES user (user_id) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        return $base->query($sql);
    }
    
    private function load_data() {
        
        return ;
    }
}