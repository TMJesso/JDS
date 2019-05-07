<?php
require_once '../../includes/add_data.php';
class CreateDataTables {
    private $ad;
    
    
    public function __construct() {
        $this->ad = new AddData();
        $this->cMenu_Type(true);
        $this->cMenu(true);
        $this->cMenu_Tier1(true);
        $this->cMenu_Tier2(true);
        $this->cUserDetails(true);
        $this->cUser(true);
        $this->cYekym(true);
        $this->cSummary(true);
        $this->cUser_Logins(true);
        $this->cUserUnPw(true);
        $this->cLoginCodes(true);
        
    }
    
    
    /**
     * Menu
     * 
     * it will also add data to the table
     * 
     * @warning menu_type table must exist before creating this table
     * 
     * @param boolean $logic
     */
    public function cMenu($logic=false) {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS menu ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "m_id varbinary(12) NOT NULL, ";
        $sql .= "type_id varbinary(12) NOT NULL, ";
        $sql .= "name varchar(20) NOT NULL, ";
        $sql .= "m_url varchar(75) DEFAULT NULL, ";
        $sql .= "m_order int(2) NOT NULL DEFAULT '0', ";
        $sql .= "visible tinyint(1) NOT NULL DEFAULT '0', ";
        $sql .= "security int(1) NOT NULL DEFAULT '9', ";
        $sql .= "clearance int(1) NOT NULL DEFAULT '9', ";
        $sql .= "PRIMARY KEY (m_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "KEY m_order (m_order), ";
        $sql .= "KEY type_id (type_id), ";
        $sql .= "KEY name (name), ";
        $sql .= "FOREIGN KEY (type_id) REFERENCES menu_type (type_id) ";
        $sql .= "ON DELETE CASCADE ON UPDATE CASCADE ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        if ($base->query($sql)) {
            if ($logic) {
                $this->ad->mData(false);
            }
        }
    }
    
    /**
     * Menu Type
     * 
     * @warning this must exist before all other menu tables are created
     * 
     * @param boolean $logic
     */
    public function cMenu_Type($logic=false) {
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
        if ($base->query($sql)) {
            if ($logic) {
                $this->ad->mtData(false);
            }
        }
    }
    
    /**
     * Menu Tier1
     * 
     * @warning menu must exist before this table is created
     * 
     * @param boolean $logic
     */
    public function cMenu_Tier1($logic=false) {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS menu_tier1 ( ";
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
        $sql .= "KEY menu (menu_id,t1_order), ";
        $sql .= "KEY name (name,t1_order), ";
        $sql .= "KEY security (t1_security,t1_clearance,t1_order), ";
        $sql .= "FOREIGN KEY (menu_id) REFERENCES menu (m_id) "; 
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        if ($base->query($sql)) {
            if ($logic) {
                $this->ad->tier1Data(false);
            }
        }
    }
    
    /**
     * Menu Tier2
     * 
     * @warning Menu Tier1 must exist before this is created
     * 
     * @param boolean $logic
     */
    public function cMenu_Tier2($logic=false) {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS menu_tier2 ( ";
        $sql .= "id int(11) NOT NULL DEFAULT '0', ";
        $sql .= "t2_id varbinary(12) NOT NULL, ";
        $sql .= "t1_id varbinary(12) NOT NULL, ";
        $sql .= "name varchar(15) NOT NULL, ";
        $sql .= "t2_url varchar(75) NOT NULL, ";
        $sql .= "t2_order int(2) NOT NULL DEFAULT '0', ";
        $sql .= "t2_visible tinyint(1) NOT NULL DEFAULT '0', ";
        $sql .= "t2_security int(1) NOT NULL DEFAULT '9', ";
        $sql .= "t2_clearance int(1) NOT NULL DEFAULT '9', ";
        $sql .= "PRIMARY KEY (t2_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "KEY name (name), ";
        $sql .= "KEY t1_id (t1_id), ";
        $sql .= "KEY t2_order (t1_id,t2_order), ";
        $sql .= "FOREIGN KEY (t1_id) REFERENCES menu_tier1 (t1_id) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        if ($base->query($sql)) {
            if ($logic) {
                $this->ad->tier2Data(false);
            }
        }
    }
    
    /**
     * User
     * 
     * @warning User Detail must exist before this is created
     * 
     * @param boolean $logic
     */
    public function cUser($logic=false) {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS user ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "user_id varbinary(12) NOT NULL, ";
        $sql .= "username varbinary(50) NOT NULL, ";
        $sql .= "passcode varchar(72) NOT NULL, ";
        $sql .= "changepass tinyint(1) NOT NULL DEFAULT '0', ";
        $sql .= "security int(1) NOT NULL DEFAULT '9', ";
        $sql .= "clearance int(1) NOT NULL DEFAULT '9', ";
        $sql .= "PRIMARY KEY (user_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "UNIQUE KEY username (username), ";
        $sql .= "KEY security (security), ";
        $sql .= "KEY clearance (clearance), ";
        $sql .= "FOREIGN KEY (user_id) REFERENCES user_details (user_id) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        if ($base->query($sql)) {
            if ($logic) {
                $this->ad->uData(false);
            }
        }
    }
    
    /**
     * User Details
     * 
     * @warning this (User Details) must exist before user is created
     * 
     * @param boolean $logic
     */
    public function cUserDetails($logic=false) {
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
        $sql .= "entity varchar(75) DEFAULT NULL, ";
        $sql .= "PRIMARY KEY (detail_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "UNIQUE KEY user_id (user_id), ";
        $sql .= "KEY name (fname,lname), ";
        $sql .= "KEY rev_name (lname,fname), ";
        $sql .= "KEY address (state,city,address1), ";
        $sql .= "FOREIGN KEY (user_id) REFERENCES user (user_id) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        if ($base->query($sql)) {
            if ($logic) {
                $this->ad->udData(false);
            }
        }
    }
    
    /**
     * Yekym
     * 
     * @warning this (Yekym) must exist before any of the user login tables are created
     * 
     * @param boolean $logic
     */
    public function cYekym($logic=false) {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS yekym ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "col_letter varbinary(8) NOT NULL, ";
        $sql .= "l32 varbinary(8) NOT NULL, ";
        $sql .= "l33 varbinary(8) NOT NULL, ";
        $sql .= "l35 varbinary(8) NOT NULL, ";
        $sql .= "l36 varbinary(8) NOT NULL, ";
        $sql .= "l37 varbinary(8) NOT NULL, ";
        $sql .= "l38 varbinary(8) NOT NULL, ";
        $sql .= "l40 varbinary(8) NOT NULL, ";
        $sql .= "l41 varbinary(8) NOT NULL, ";
        $sql .= "l42 varbinary(8) NOT NULL, ";
        $sql .= "l43 varbinary(8) NOT NULL, ";
        $sql .= "l44 varbinary(8) NOT NULL, ";
        $sql .= "l45 varbinary(8) NOT NULL, ";
        $sql .= "l46 varbinary(8) NOT NULL, ";
        $sql .= "l47 varbinary(8) NOT NULL, ";
        $sql .= "l48 varbinary(8) NOT NULL, ";
        $sql .= "l49 varbinary(8) NOT NULL, ";
        $sql .= "l50 varbinary(8) NOT NULL, ";
        $sql .= "l51 varbinary(8) NOT NULL, ";
        $sql .= "l52 varbinary(8) NOT NULL, ";
        $sql .= "l53 varbinary(8) NOT NULL, ";
        $sql .= "l54 varbinary(8) NOT NULL, ";
        $sql .= "l55 varbinary(8) NOT NULL, ";
        $sql .= "l56 varbinary(8) NOT NULL, ";
        $sql .= "l57 varbinary(8) NOT NULL, ";
        $sql .= "l58 varbinary(8) NOT NULL, ";
        $sql .= "l59 varbinary(8) NOT NULL, ";
        $sql .= "l60 varbinary(8) NOT NULL, ";
        $sql .= "l61 varbinary(8) NOT NULL, ";
        $sql .= "l62 varbinary(8) NOT NULL, ";
        $sql .= "l63 varbinary(8) NOT NULL, ";
        $sql .= "l64 varbinary(8) NOT NULL, ";
        $sql .= "l65 varbinary(8) NOT NULL, ";
        $sql .= "l66 varbinary(8) NOT NULL, ";
        $sql .= "l67 varbinary(8) NOT NULL, ";
        $sql .= "l68 varbinary(8) NOT NULL, ";
        $sql .= "l69 varbinary(8) NOT NULL, ";
        $sql .= "l70 varbinary(8) NOT NULL, ";
        $sql .= "l71 varbinary(8) NOT NULL, ";
        $sql .= "l72 varbinary(8) NOT NULL, ";
        $sql .= "l73 varbinary(8) NOT NULL, ";
        $sql .= "l74 varbinary(8) NOT NULL, ";
        $sql .= "l75 varbinary(8) NOT NULL, ";
        $sql .= "l76 varbinary(8) NOT NULL, ";
        $sql .= "l77 varbinary(8) NOT NULL, ";
        $sql .= "l78 varbinary(8) NOT NULL, ";
        $sql .= "l79 varbinary(8) NOT NULL, ";
        $sql .= "l80 varbinary(8) NOT NULL, ";
        $sql .= "l81 varbinary(8) NOT NULL, ";
        $sql .= "l82 varbinary(8) NOT NULL, ";
        $sql .= "l83 varbinary(8) NOT NULL, ";
        $sql .= "l84 varbinary(8) NOT NULL, ";
        $sql .= "l85 varbinary(8) NOT NULL, ";
        $sql .= "l86 varbinary(8) NOT NULL, ";
        $sql .= "l87 varbinary(8) NOT NULL, ";
        $sql .= "l88 varbinary(8) NOT NULL, ";
        $sql .= "l89 varbinary(8) NOT NULL, ";
        $sql .= "l90 varbinary(8) NOT NULL, ";
        $sql .= "l91 varbinary(8) NOT NULL, ";
        $sql .= "l92 varbinary(8) NOT NULL, ";
        $sql .= "l93 varbinary(8) NOT NULL, ";
        $sql .= "l94 varbinary(8) NOT NULL, ";
        $sql .= "l95 varbinary(8) NOT NULL, ";
        $sql .= "l97 varbinary(8) NOT NULL, ";
        $sql .= "l98 varbinary(8) NOT NULL, ";
        $sql .= "l99 varbinary(8) NOT NULL, ";
        $sql .= "l100 varbinary(8) NOT NULL, ";
        $sql .= "l101 varbinary(8) NOT NULL, ";
        $sql .= "l102 varbinary(8) NOT NULL, ";
        $sql .= "l103 varbinary(8) NOT NULL, ";
        $sql .= "l104 varbinary(8) NOT NULL, ";
        $sql .= "l105 varbinary(8) NOT NULL, ";
        $sql .= "l106 varbinary(8) NOT NULL, ";
        $sql .= "l107 varbinary(8) NOT NULL, ";
        $sql .= "l108 varbinary(8) NOT NULL, ";
        $sql .= "l109 varbinary(8) NOT NULL, ";
        $sql .= "l110 varbinary(8) NOT NULL, ";
        $sql .= "l111 varbinary(8) NOT NULL, ";
        $sql .= "l112 varbinary(8) NOT NULL, ";
        $sql .= "l113 varbinary(8) NOT NULL, ";
        $sql .= "l114 varbinary(8) NOT NULL, ";
        $sql .= "l115 varbinary(8) NOT NULL, ";
        $sql .= "l116 varbinary(8) NOT NULL, ";
        $sql .= "l117 varbinary(8) NOT NULL, ";
        $sql .= "l118 varbinary(8) NOT NULL, ";
        $sql .= "l119 varbinary(8) NOT NULL, ";
        $sql .= "l120 varbinary(8) NOT NULL, ";
        $sql .= "l121 varbinary(8) NOT NULL, ";
        $sql .= "l122 varbinary(8) NOT NULL, ";
        $sql .= "l123 varbinary(8) NOT NULL, ";
        $sql .= "l125 varbinary(8) NOT NULL, ";
        $sql .= "PRIMARY KEY (col_letter), ";
        $sql .= "UNIQUE KEY id (id) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        if ($base->query($sql)) {
            if ($logic) {
                $this->ad->yekData();
            }
        }
    }
    
    /**
     * User Logins
     * 
     * @warnings Yekym must exist before this is created
     * 
     * @param boolean $logic
     */
    public function cUser_Logins($logic=false) {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS user_logins ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "login_id varbinary(12) NOT NULL, ";
        $sql .= "user_id varbinary(12) NOT NULL, ";
        $sql .= "descript varchar(75) NOT NULL, ";
        $sql .= "url varchar(150) NOT NULL, ";
        $sql .= "PRIMARY KEY (login_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "KEY user_id (user_id), ";
        $sql .= "FOREIGN KEY (user_id) REFERENCES user (user_id) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        if ($base->query($sql)) {
            if ($logic) {
                $this->ad->ulData(false);
            }
        }
    }
    
    /**
     * Login Codes
     * 
     * @warnings User UnPw must exist before this is created
     * 
     * @param boolean $logic
     */
    public function cLoginCodes($logic=false) {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS login_codes ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "codes_id varbinary(12) NOT NULL, ";
        $sql .= "unpw_id varbinary(12) NOT NULL, ";
        $sql .= "multiplier varbinary(12) NOT NULL, ";
        $sql .= "codex varbinary(12) NOT NULL, ";
        $sql .= "weight varbinary(12) NOT NULL, ";
        $sql .= "slt varbinary(22) NOT NULL, ";
        $sql .= "code_order int(6) NOT NULL DEFAULT '999999', ";
        $sql .= "PRIMARY KEY (codes_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "KEY unpw_id (unpw_id), ";
        $sql .= "KEY code_order (unpw_id,code_order), ";
        $sql .= "FOREIGN KEY (unpw_id) REFERENCES user_unpw (unpw_id) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        if ($base->query($sql)) {
            if ($logic) {
                $this->ad->lcData(false);
            }
        }
        
    }
    
    /**
     * User UnPw
     * 
     * @warnings User Logins must exist before this is created
     * 
     * @param boolean $logic
     */
    public function cUserUnPw($logic=false) {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS user_unpw ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "unpw_id varbinary(12) NOT NULL, ";
        $sql .= "login_id varbinary(12) NOT NULL, ";
        $sql .= "user_pass tinyint(1) NOT NULL DEFAULT '0', ";
        $sql .= "PRIMARY KEY (unpw_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "KEY login_id (login_id) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        if ($base->query($sql)) {
            if ($logic) {
                $this->ad->unpwData(false);
            }
        }
    }
    
    /**
     * Summary
     * 
     * @warnings User must exist before this is created
     * 
     * @param boolean $logic
     */
    public function cSummary($logic=false) {
        global $base;
        $sql  = "CREATE TABLE IF NOT EXISTS summary ( ";
        $sql .= "id int(11) NOT NULL AUTO_INCREMENT, ";
        $sql .= "sum_id varbinary(12) NOT NULL, ";
        $sql .= "user_id varbinary(12) NOT NULL, ";
        $sql .= "descript varchar(255) DEFAULT NULL, ";
        $sql .= "last_update datetime DEFAULT '1900-01-01 00:00:00', ";
        $sql .= "visible tinyint(1) NOT NULL DEFAULT '0', ";
        $sql .= "sorder int(3) NOT NULL DEFAULT '999', ";
        $sql .= "PRIMARY KEY (sum_id), ";
        $sql .= "UNIQUE KEY id (id), ";
        $sql .= "KEY user_id (user_id), ";
        $sql .= "KEY sorder (sorder), ";
        $sql .= "FOREIGN KEY (user_id) REFERENCES user (user_id)";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";
        if ($base->query($sql)) {
            if ($logic) {
                $this->ad->sData(false);
            }
        }
    }
    
    //public function cUserLogin
}
$cd = new CreateDataTables();




function workhorse($data) {
    foreach ($data as $dt) {
        $codes= new Codes();
        $codes->codes_id = $dt[1];
        $codes->unpw_id = $dt[2];
        $codes->multiplier = $dt[3];
        $codes->codex = $dt[4];
        $codes->weight = $dt[5];
        $codes->slt = $dt[6];
        $codes->code_order = $dt[7];
        $codes->save();
    }
    
}
