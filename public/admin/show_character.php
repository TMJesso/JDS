<?php
require_once '../../includes/initialize.php';

// $character = "^";
// $char = ord($character);
// $value = "s";
// $code = ord($value);
// $get_char = Yekym::get_character($char, $code);
$this_txt = "This is a\\ te/st!";
$x_key = array();
$multiplier = array();
$codex = array();
$weight = array();
echo $this_txt . "<br>";
for ($y = 0; $y < strlen($this_txt); $y++) {
    $my_chr = substr($this_txt, $y, 1);
    $weit = get_random_value(2, 9);
    $x_value = get_random_number();
    $x_key[] = $x_value;
    $multiplier[] = strrev(dechex(($weit * $x_value)));
    if (ord($my_chr) === 32) {
        $str_value = " ";
    } else {
        $str_value = Yekym::generate_code($x_value, $my_chr);
    }
    //var_dump($str_value);
    $codex[] = strrev(dechex($weit * ord($str_value)));
    $weight[] = (string)$weit;
}
echo "<br>";
for ($x = 0; $x < count($multiplier); $x++) {
    echo substr($this_txt, $x, 1) . " :: ";
    echo "X value: " . $x_key[$x];
    echo " :: Multiplier value: " . $multiplier[$x];
    echo " :: Y value: " . $codex[$x];
    echo " :: Weight value: " . $weight[$x];
    echo "<br>";
}
// echo $char . " :: " . $code . "<br>" . chr($get_char);
?>

<?php 
function get_random_number() {
    $loop = true;
    $n = null;
    while ($loop) {
        $n = mt_rand(32, 122);
        switch ($n) {
            case 32: case 34: case 39: case 43: case 95: case 96:
                break;
            default:
                $loop = false;
        }
    }
    return $n;
}

?>

