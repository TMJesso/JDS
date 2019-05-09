<?php

/**
 * debugging tool
 *
 * $input is the variable being passed in
 *
 * $desc is optional and it will display in the mylog file
 * @param $input
 * @param $desc
 */
function log_data_verbose($input, $desc=""){
    $string_format = var_export($input, true);
    $file = fopen(DS . "mylog.txt", "a");
    fwrite($file, "\n{\n" . var_export(date("h:i:s a m/d/y"), true) . " From: " . $_SERVER["REQUEST_URI"] . "\n");
    fwrite($file, "Value: " . $string_format);
    if (!empty($desc)) {
        fwrite($file, "\n[ " . $desc . " ]\n }\n\n");
    } else {
        fwrite($file, "No Description given\n}\n\n");
    }
    fclose($file);
}

function include_layout_template($template="") {
    include(LAYOUT.$template);
}

function get_security_text($num=0) {
    $sec_text = array('Admin', 'CFO', 'General Manager', 'Department Manager', 'Superintendent', 'Shift Supervisor', 'Foreman', 'Leader', 'Production', 'Public');
    if ($num < count($sec_text)) {
        return $sec_text[$num];
    } else {
        return false;
    }
}

function get_clearance_text($num=0) {
    $clr_text = array('High-High', 'High-Medium', 'High-Low', 'Medium-High', 'Medium-Medium', 'Medium-Low', 'Low-High', 'Low-Medium', 'Low-Low', 'Public');
    if ($num < count($clr_text)) {
        return $clr_text[$num];
    } else {
        return false;
    }
}

function get_new_id() {
    $id = "";
    
    for ($x = 1; $x < 13; $x++) {
        $id .= get_random_letter();
    }
    
    return $id;
    //return chr(mt_rand(65, 90)) . chr(mt_rand(65, 90)) . chr(mt_rand(65, 90)) . "00";
}

function get_random_letter() {
    $letter = "";
    switch (get_random_value()) {
        case 1:
            $letter = chr(mt_rand(48, 57)); // number
            break;
        case 2:
            $letter = chr(mt_rand(65, 90)); // upper case letter
            break;
        case 3:
            $letter = chr(mt_rand(97, 122)); // lower case letter
            break;
    }
    return $letter;
}

function get_random_value($min=1, $max=3) {
    return mt_rand($min, $max);
}

function output_message($message="") {
    if (!empty($message)) {
        return "<br/><div class=\"success callout text-center\"><h5>{$message}</h5></div>";
    } else {
        return "";
    }
}

function output_errors($errors="") {
    if (!empty($errors)) {
        return "<br/><div class=\"alert callout text-center\"><h4>{$errors}</h4></div>";
    } else {
        return "";
    }
}

function redirect_to($location = null) {
    if (!is_null($location)) {
        header("Location: {$location}");
        exit;
    }
}

function has_presence($value) {
    return ((isset($value) && $value !== "") || is_numeric($value));
}

/** urlencode
 *
 * @param string $code
 * @return string
 */
function ucode($code) {
    return urlencode($code);
}

/** urldecode
 *
 * @param string $code
 * @return string
 */
function udcode($code) {
    return urldecode($code);
}

/** html enties encode
 *
 *
 * @param string $entities
 * @param int $ent default ENT_QUOTES
 * @return string
 */
function hent($entities, $ent=ENT_QUOTES) {
    return htmlentities($entities, $ent);
}

/** html entities decode
 *
 * @param string $entities
 * @param int $ent default = ENT_QUOTES
 * @return string
 */
function hdent($entities, $ent=ENT_QUOTES) {
    return html_entity_decode($entities, $ent);
}

function show_title($title) { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
        </div>
        <div class="large-6 medium-6 cell">
        	<h4 class="text-center"><?php echo $title; ?></h4>
        </div>
        <div class="large-3 medium-3 cell">
 	       &nbsp;
        </div>
    </div>
</div>
<?php 
}

function password_encrypt($password) {
    $hash = password_hash($password, PASSWORD_DEFAULT); // php7 built in blowfish encryption
    return $hash;
}

function password_check($password, $existing_hash) {
    return password_verify($password, $existing_hash); // php7 builtin password verification
}

/**
 * Filename must include path eg. TRACKER.$filename CANNOT be blank
 * 
 * if using the param variables :
 * 
 * $param1 must include first ? eg. ?id=
 * 
 * $param2 - $param4 must include additional & eg. &tid=
 * 
 * @param string $filename
 * @param string $param1
 * @param string $param2
 * @param string $param3
 * @param string $param4
 */
function open_form($filename, $param1='', $param2='', $param3='', $param4='') {
    if (empty($filename)) {
        return false;
    }
    ?>
			<form data-abide novalidate method="post" action="<?php echo $filename.$param1.$param2.$param3.$param4; ?>">
            	<div data-abide-error class="alert callout" style="display: none;">
            		<p><i class="fi-alert"></i> Please scroll down to view all errors on form.</p>
				</div>
    <?php 
    
}


function close_form() {
    ?>
    		</form>
    <?php 
}


function show_how_many($howmany) {
    if ($howmany) { ?>
		<h5 class="text-center">Trackers<br><?php echo $howmany; ?></h5><br><br>
	<?php } else { ?>
		&nbsp;
	<?php } 
}

function get_username($un) {
    $uncodes = Codes::get_codes_by_id($un->unpw_id);
    $username = "";
    foreach ($uncodes as $uncd) {
        $username .= $uncd->multiplier.$uncd->slt.$uncd->codex;
    }
    return $username;
}

function get_passcode($pw) {
    $pwcodes = Codes::get_codes_by_id($pw->unpw_id);
    $passcode = "";
    foreach ($pwcodes as $pwcd) {
        $passcode .= $pwcd->multiplier.$pwcd->slt.$pwcd->codex;
    }
    return $passcode;
}

function get_un($tracker) {
    $unpw = UnPw::get_all_by_login_id($tracker);
    foreach ($unpw as $uw) {
        if ($uw->user_pass) {
            $pw = $uw;
        } else {
            $un = $uw;
        }
    }
    return $un;
}

function get_pw($tracker) {
    $unpw = UnPw::get_all_by_login_id($tracker);
    foreach ($unpw as $uw) {
        if ($uw->user_pass) {
            $pw = $uw;
        } else {
            $un = $uw;
        }
    }
    return $pw;
}

function now() {
    return date(now_format());
}

function now_format() {
    //"m-d-Y H:i:s"
    return "Y-m-d H:i:s";
}

function get_cancel_button($name='index.php', $value='Cancel') {
    ?>
    <a href="<?php echo $name; ?>" class="button"><?php echo $value; ?></a>
    <?php 
}


function get_reset_button() {
    ?>
    <input type="reset" name="reset_addmenu" class="button" value="Reset">
    <?php
}


function get_submit_button($name='submit_button', $label='Save') {
    ?>
    <input type="submit" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="button" value="<?php echo $label; ?>">
    <?php 
}


function get_path_filename() {
	$len = strlen(dirname($_SERVER["SCRIPT_NAME"]));
	$path = dirname($_SERVER["SCRIPT_NAME"]);
	$filename = substr($_SERVER["SCRIPT_NAME"], $len + 1, strlen($_SERVER['SCRIPT_NAME']));
	// 	echo "Path: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $path . "<br><br>";
	// 	echo "Filename: " . $filename . "<br><br>";
	return array("path"=>$path, "filename"=>$filename);
}



?>

