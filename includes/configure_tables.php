<?php
require_once '../../includes/database.php';
class Config extends Factory {
    //private static $table_names = array();
    
    public function create_tables() {
        $this->create_user_values();
        $this->create_menu_table();
    }
    
    /**
     * Create table Menu
     * 
     * <h1> user_values table must already exist</h1>
     * 
     * @see create_user_values();
     * 
     * 
     * 
     */
    private function create_menu_table() {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS menu ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "menu_id BINARY(11) NOT NULL, ";
        $sql .= "url varchar(50) NOT NULL, ";
        $sql .= "find_text varchar(40) NOT NULL, ";
        $sql .= "link_text varchar(20) NOT NULL, ";
        $sql .= "menu_order int(2) NOT NULL, ";
        $sql .= "visible tinyint(1) NOT NULL, ";
        $sql .= "security int(1) NOT NULL, ";
        $sql .= "clearance int(1) NOT NULL, ";
        $sql .= "not_logged_in tinyint(1) NOT NULL DEFAULT '0', ";
        $sql .= "PRIMARY KEY (menu_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "INDEX find_text (find_text), ";
        $sql .= "INDEX link_text (link_text), ";
        $sql .= "INDEX security (security), ";
        $sql .= "INDEX clearance (clearance), ;";
        $sql .= "FOREIGN KEY (security) REFERENCES user_values (security), ";
        $sql .= "FOREIGN KEY (clearance) REFERENCES access_values (clearance)) ";
        $sql .= "ENGINE = InnoDB DEFAULT CHARSET=utf8";
        $base->query($sql);
    }
    
    private function create_user_values() {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXIST user_values ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "security int(1) NOT NULL, ";
        $sql .= "name varchar(15) NOT NULL, ";
        $sql .= "PRIMARY KEY (security), ";
        $sql .= "UNIQUE INDEX id (id), ";
        $sql .= "INDEX name (name) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $base->query($sql);
        
    }
}


?>
