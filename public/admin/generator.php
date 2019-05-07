<?php 
echo "NOT ABLE TO RUN AGAIN!!!!";
return;


require_once '../../includes/initialize.php';
require_once 'generate_tables.php';
$n = null;
$num = array(array());
// echo "1: ";
// echo count($num);
// echo "<br>";
// echo "2: ";
// echo does_it_already_exist($num, 7)? "True" : "False";
// echo "<br>";
// return;
for ($x = 0; $x < 90; $x++) {
     for ($y = 0; $y < 90; $y++) {
         $n = get_random_number();
         $num[$x][$y] = null;
         while (does_it_already_exist($num[$x], $n)) { 
            $n = get_random_number();
         }
        if (is_null($n)) {
            die("Unable to continue NULL value!");
        }        
        $num[$x][$y] = $n;
    }
}
for ($x = 0; $x < count($num); $x++) {
    $new_ltr = new Yekym();
    
    echo $x . ": ";
    for ($y = 0; $y < count($num[$x]); $y++) {
        echo $num[$x][$y] . ", ";
    }
    $letter = array();
    $nl = null;
    for ($t = 0; $t < count($num); $t++) {
        $nl = get_random_number();
        while(does_it_already_exist($letter, $nl)) {
            $nl = get_random_number();
        }
        $letter[] = $nl;
    }
    
        $new_ltr->col_letter = chr($letter[$x]);
        $new_ltr->l32 = strrev(dechex($num[$x][0]));
        $new_ltr->l33 = strrev(dechex($num[$x][1]));
        $new_ltr->l35 = strrev(dechex($num[$x][2]));
        $new_ltr->l36 = strrev(dechex($num[$x][3]));
        $new_ltr->l37 = strrev(dechex($num[$x][4]));
        $new_ltr->l38 = strrev(dechex($num[$x][5]));
        $new_ltr->l40 = strrev(dechex($num[$x][6]));
        $new_ltr->l41 = strrev(dechex($num[$x][7]));
        $new_ltr->l42 = strrev(dechex($num[$x][8]));
        $new_ltr->l43 = strrev(dechex($num[$x][9]));
        $new_ltr->l44 = strrev(dechex($num[$x][10]));
        $new_ltr->l45 = strrev(dechex($num[$x][11]));
        $new_ltr->l46 = strrev(dechex($num[$x][12]));
        $new_ltr->l47 = strrev(dechex($num[$x][13]));
        $new_ltr->l48 = strrev(dechex($num[$x][14]));
        $new_ltr->l49 = strrev(dechex($num[$x][15]));
        $new_ltr->l50 = strrev(dechex($num[$x][16]));
        $new_ltr->l51 = strrev(dechex($num[$x][17]));
        $new_ltr->l52 = strrev(dechex($num[$x][18]));
        $new_ltr->l53 = strrev(dechex($num[$x][19]));
        $new_ltr->l54 = strrev(dechex($num[$x][20]));
        $new_ltr->l55 = strrev(dechex($num[$x][21]));
        $new_ltr->l56 = strrev(dechex($num[$x][22]));
        $new_ltr->l57 = strrev(dechex($num[$x][23]));
        $new_ltr->l58 = strrev(dechex($num[$x][24]));
        $new_ltr->l59 = strrev(dechex($num[$x][25]));
        $new_ltr->l60 = strrev(dechex($num[$x][26]));
        $new_ltr->l61 = strrev(dechex($num[$x][27]));
        $new_ltr->l62 = strrev(dechex($num[$x][28]));
        $new_ltr->l63 = strrev(dechex($num[$x][29]));
        $new_ltr->l64 = strrev(dechex($num[$x][30]));
        $new_ltr->l65 = strrev(dechex($num[$x][31]));
        $new_ltr->l66 = strrev(dechex($num[$x][32]));
        $new_ltr->l67 = strrev(dechex($num[$x][33]));
        $new_ltr->l68 = strrev(dechex($num[$x][34]));
        $new_ltr->l69 = strrev(dechex($num[$x][35]));
        $new_ltr->l70 = strrev(dechex($num[$x][36]));
        $new_ltr->l71 = strrev(dechex($num[$x][37]));
        $new_ltr->l72 = strrev(dechex($num[$x][38]));
        $new_ltr->l73 = strrev(dechex($num[$x][39]));
        $new_ltr->l74 = strrev(dechex($num[$x][40]));
        $new_ltr->l75 = strrev(dechex($num[$x][41]));
        $new_ltr->l76 = strrev(dechex($num[$x][42]));
        $new_ltr->l77 = strrev(dechex($num[$x][43]));
        $new_ltr->l78 = strrev(dechex($num[$x][44]));
        $new_ltr->l79 = strrev(dechex($num[$x][45]));
        $new_ltr->l80 = strrev(dechex($num[$x][46]));
        $new_ltr->l81 = strrev(dechex($num[$x][47]));
        $new_ltr->l82 = strrev(dechex($num[$x][48]));
        $new_ltr->l83 = strrev(dechex($num[$x][49]));
        $new_ltr->l84 = strrev(dechex($num[$x][50]));
        $new_ltr->l85 = strrev(dechex($num[$x][51]));
        $new_ltr->l86 = strrev(dechex($num[$x][52]));
        $new_ltr->l87 = strrev(dechex($num[$x][53]));
        $new_ltr->l88 = strrev(dechex($num[$x][54]));
        $new_ltr->l89 = strrev(dechex($num[$x][55]));
        $new_ltr->l90 = strrev(dechex($num[$x][56]));
        $new_ltr->l91 = strrev(dechex($num[$x][57]));
        $new_ltr->l92 = strrev(dechex($num[$x][58]));
        $new_ltr->l93 = strrev(dechex($num[$x][59]));
        $new_ltr->l94 = strrev(dechex($num[$x][60]));
        $new_ltr->l95 = strrev(dechex($num[$x][61]));
        $new_ltr->l97 = strrev(dechex($num[$x][62]));
        $new_ltr->l98 = strrev(dechex($num[$x][63]));
        $new_ltr->l99 = strrev(dechex($num[$x][64]));
        $new_ltr->l100 = strrev(dechex($num[$x][65]));
        $new_ltr->l101 = strrev(dechex($num[$x][66]));
        $new_ltr->l102 = strrev(dechex($num[$x][67]));
        $new_ltr->l103 = strrev(dechex($num[$x][68]));
        $new_ltr->l104 = strrev(dechex($num[$x][69]));
        $new_ltr->l105 = strrev(dechex($num[$x][70]));
        $new_ltr->l106 = strrev(dechex($num[$x][71]));
        $new_ltr->l107 = strrev(dechex($num[$x][72]));
        $new_ltr->l108 = strrev(dechex($num[$x][73]));
        $new_ltr->l109 = strrev(dechex($num[$x][74]));
        $new_ltr->l110 = strrev(dechex($num[$x][75]));
        $new_ltr->l111 = strrev(dechex($num[$x][76]));
        $new_ltr->l112 = strrev(dechex($num[$x][77]));
        $new_ltr->l113 = strrev(dechex($num[$x][78]));
        $new_ltr->l114 = strrev(dechex($num[$x][79]));
        $new_ltr->l115 = strrev(dechex($num[$x][80]));
        $new_ltr->l116 = strrev(dechex($num[$x][81]));
        $new_ltr->l117 = strrev(dechex($num[$x][82]));
        $new_ltr->l118 = strrev(dechex($num[$x][83]));
        $new_ltr->l119 = strrev(dechex($num[$x][84]));
        $new_ltr->l120 = strrev(dechex($num[$x][85]));
        $new_ltr->l121 = strrev(dechex($num[$x][86]));
        $new_ltr->l122 = strrev(dechex($num[$x][87]));
        $new_ltr->l123 = strrev(dechex($num[$x][88]));
        $new_ltr->l125 = strrev(dechex($num[$x][89]));
        $new_ltr->save();
//     }
    echo "<br><br>";
}


function get_random_number() {
    $loop = true;
    $n = null;
    while ($loop) {
        $n = mt_rand(32, 125);
        switch ($n) {
            case 34: case 39: case 96: case 124:
                break;
            default:
                $loop = false;
        }
    }
    return $n;
}

function does_it_already_exist($check, $n) {
    for ($x = 0; $x < count($check); $x++) {
        if ($n === $check[$x]) {
            return true;
        }
    }
    return false;
}
?>
