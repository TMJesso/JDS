<?php
// connect to mysql database server either local or online
if ($_SERVER["SERVER_NAME"] == "localhost") {
	defined('DB_SERVER')	? null : define('DB_SERVER', 'localhost');
	defined('DB_USER')		? null : define('DB_USER', 'jkOP89x33');
	defined('DB_PASS')		? null : define('DB_PASS', 'Va3ILdAfsQWe2sQb');
	defined('DB_NAME')		? null : define('DB_NAME', '07012018_636c6164');
	defined('DB_PORT')		? null : define('DB_PORT', 3308);
	defined('DB_SOCKET')	? null : define('DB_SOCKET', null);
} elseif ($_SERVER["SERVER_NAME"] == "theraljessop.net" || $_SERVER["SERVER_NAME"] == "theraljessopnet.ipage.com") {
	$db_user = call_get_dbuser();
    defined('DB_SERVER')	? null : define('DB_SERVER', 'theraljessopnet.ipagemysql.com');
	defined('DB_USER')		? null : define('DB_USER', $db_user[0]);
	defined('DB_PASS')		? null : define('DB_PASS', $db_user[1]);
	defined('DB_NAME')		? null : define('DB_NAME', '07012018_636c6164');
	defined('DB_PORT')		? null : define('DB_PORT', 3306);
	defined('DB_SOCKET')	? null : define('DB_SOCKET', null);
}


function call_get_dbuser() {
    switch (get_random_value(0, 7)) {
        case 0: // group 0
            switch (get_random_value(0, 9)) { // user 
                case 0:
                    return array('user0group0', '6kiw4tewnafnv8xx');
                    
                case 1:
                    return array('user1group0', '6adev7bqnyaw6vcz');
                		
                case 2:
                    return array('user2group0', '48fludwjbmzqdy7a');
                		
                case 3:
                    return array('user3group0', 'rlnb2rk6gwd4jrgn');
                    
                case 4:
                    return array('user4group0', 'cxrkuolnv7gmn64z');
                    
                case 5:
                    return array('user5group0', 'xwpr39hj9fnqebpg');
                    
                case 6:
                    return array('user6group0', '4z4qpg6fqtmiuhwb');
                    
                case 7:
                    return array('user7group0', 'hgdeuxdc8j4lj8qj');
                    
                case 8:
                    return array('user8group0', 'fv6gbjgfce8u2bov');
                    
                case 9:
                    return array('user9group0', 'hywzapwx3sks68bi');
                    
            }
            break;
            
        case 1: // group 1
            switch (get_random_value(0, 9)) { // user
                case 0:
                    return array('user0group1', 'j3r2obtutwja3nkx');
                    
                case 1:
                    return array('user1group1', 'qibkak7h2a6vfazq');
                    
                case 2:
                    return array('user2group1', 'ermkwuccn82ad6wp');
                    
                case 3:
                    return array('user3group1', '82u4qvyumfulwkal');
                    
                case 4:
                    return array('user4group1', 'vf9y2m9awjkymypf');
                    
                case 5:
                    return array('user5group1', 'ckq7jvzbnbd89wdq');
                    
                case 6:
                    return array('user6group1', 'racseow3t2g7jxqt');
                    
                case 7:
                    return array('user7group1', 'px2ohyo42gkrgfzj');
                    
                case 8:
                    return array('user8group1', 'iscaoqud7g4br7zv');
                    
                case 9:
                    return array('user9group1', 'dyemxgf7w8dxag7j');
                    
            }
            break;
            
        case 2:
            switch (get_random_value(0, 9)) { // user
                case 0:
                    return array('user0group2', 'yngtj4vy97xdagwr');
                    
                case 1:
                    return array('user1group2', 'hmjwgjex96hcwe3e');
                    
                case 2:
                    return array('user2group2', 'y7zfhhkp9bvkut7q');
                    
                case 3:
                    return array('user3group2', '4m4jcy3idlvxybdv');
                    
                case 4:
                    return array('user4group2', 'skqgalxu492jwqfh');
                    
                case 5:
                    return array('user5group2', '7xmbnmjy4f4xmwiz');
                    
                case 6:
                    return array('user6group2', 'heuypzcuu4hj6i3x');
                    
                case 7:
                    return array('user7group2', 'rxxg6wdn2lyeyr2n');
                    
                case 8:
                    return array('user8group2', 'f3qvyexrh8le2xfe');
                    
                case 9:
                    return array('user9group2', 'wvemp9fvyc8u2fnr');
            }
            break;
            
        case 3:
            switch (get_random_value(0, 9)) { // user
                case 0:
                    return array('user0group3', '3cxiqlaywtw9v8gv');
                    
                case 1:
                    return array('user1group3', 'mwdcv67qorz2pzmf');
                    
                case 2:
                    return array('user2group3', 'qg9yef6jdudnkw3m');
                    
                case 3:
                    return array('user3group3', 'y37gkzqgg4ztpzvr');
                    
                case 4:
                    return array('user4group3', '8kencup3azwtf8bm');
                    
                case 5:
                    return array('user5group3', 'r6ymspgyong7hj2e');
                    
                case 6:
                    return array('user6group3', 'gdzcnq49gkdvhm8k');
                    
                case 7:
                    return array('user7group3', '7b6hvgxjadpmbn2y');
                    
                case 8:
                    return array('user8group3', '29qfpdpzh8avxcqz');
                    
                case 9:
                    return array('user9group3', '2wxfqe8e8jzanhnf');
                    
            }
            break;
            
        case 4:
            switch (get_random_value(0, 9)) { // user
                case 0:
                    return array('user0group4', 'p2xqx6u3ztgxtpng');
                    
                case 1:
                    return array('user1group4', 'lhwzqnr7hdbu48ha');
                    
                case 2:
                    return array('user2group4', '37edwhargbeepd3e');
                    
                case 3:
                    return array('user3group4', 'ke3c7zfnwpfrx6jt');
                    
                case 4:
                    return array('user4group4', 'cy6kjcfydh6gz9up');
                    
                case 5:
                    return array('user5group4', 'hcdkdr2e2ye3qygt');
                    
                case 6:
                    return array('user6group4', '9vfm6zxpe7vyfvum');
                    
                case 7:
                    return array('user7group4', '8itx6pgjqtmmv2ev');
                    
                case 8:
                    return array('user8group4', 'j73vo2yclzbtmgny');
                    
                case 9:
                    return array('user9group4', 'bs7fmxo9lac4gcba');
                    
            }
            break;
            
        case 5:
            switch (get_random_value(0, 9)) { // user
                case 0:    
                    return array('user0group5', 'v6kjebmu8x2cpkcw');
                    
                case 1:
                    return array('user1group5', 'w7hwcjeedz9eps2y');
                    
                case 2:
                    return array('user2group5', 'f2yve3iydxzwoj7c');
                    
                case 3:
                    return array('user3group5', '36qncm7rmtyhqjyj');
                    
                case 4:
                    return array('user4group5', '8rx4gvptdzj3tred');
                    
                case 5:
                    return array('user5group5', '4n9ebavhkhxc4zrt');
                    
                case 6:
                    return array('user6group5', 'g7kw9crwmdj3crkr');
                    
                case 7:
                    return array('user7group5', 'nvcfzwgvmu2b7e8w');
                    
                case 8:
                    return array('user8group5', 't6m8pigafntn2hnc');
                    
                case 9:
                    return array('user9group5', 'qjmg6f4utkndyt4m');
                    
            }
            break;
            
        case 6:
            switch (get_random_value(0, 9)) { // user
                case 0:
                    return array('user0group6', 'rx3mq6aqctff2zma');
            
                case 1:
                    return array('user1group6', 's38hfgqf9btfvjbz');
                    
                case 2:
                    return array('user2group6', 'jq3tscxubfwrw36m');
                    
                case 3:
                    return array('user3group6', 'thintgtd673mxwae');
                    
                case 4:
                    return array('user4group6', 'xazv2kzc3hj7nhja');
                    
                case 5:
                    return array('user5group6', 'btmvpf7v7xtcq8so');
                    
                case 6:
                    return array('user6group6', '6hgh8t4fxhlgcrnp');
                    
                case 7:
                    return array('user7group6', 'qdar6fusfgl7d9wm');
                    
                case 8:
                    return array('user8group6', '6vydytm8o2qwmfyv');
                    
                case 9:
                    return array('user9group6', '9ha3f2yxamqqaurq');
                    
            }
            break;
            
        case 7:
            switch (get_random_value(0, 9)) { // user
                case 0:
                    return array('user0group7', 'd8jixbcm9kma7yjj');
                    
                case 1:
                    return array('user1group7', '8dm4jxpbp9tsuhpn');
                    
                case 2:
                    return array('user2group7', 'ob3yyka3krb8ajte');
                    
                case 3:
                    return array('user3group7', 's8umhapk4cbf8ijy');
                    
                case 4:
                    return array('user4group7', '3cf3uontewuew9lp');
                    
                case 5:
                    return array('user5group7', 'eqy8et87nuzspyqu');
                    
                case 6:
                    return array('user6group7', 'zk2xeyt3jbf6wwai');
                    
                case 7:
                    return array('user7group7', '93uxblg7xxtsdzas');
                    
                case 8:
                    return array('user8group7', '3you8gq3vzjdbabb');
                    
                case 9:
                    return array('user9group7', 'iub83xv4cpcyjqnz');
             }
            break;
            
        default:
            return array('m9eewxb_lqjmdk0r', 'pjyta_sz8cv94pgk');
    }
}




?>
