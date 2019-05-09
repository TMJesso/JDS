<?php
require_once '../../../../includes/initialize.php';
if (!$session->is_logged_in()) { $session->logout(); redirect_to(ADMIN_PATH.'login.php'); }
$menu_type = Menu_Type::get_by_type("Tracker", 9);
$subtitle = CO_ABBR . " Password Tracker";

$howmany = Login::howmany();
$user = User::get_user_by_username($session->get_user_id());
$first_load = true;
$second_load = false;
$pw_button = false;
$username_button = false;
$form_file = TRACKER . 'show_tracker.php';
if (isset($_POST['select_tracker'])) {
    $first_load = false;
    $second_load = true;
    $tid = $_POST['select_tracker'];
    $tracker = Login::get_login_by_id($tid);
    $un = get_un($tracker->login_id);
    $pw = get_pw($tracker->login_id);
    $username = get_username($un);
    $passcode = get_passcode($pw);
} elseif (isset($_POST['submit_decode_username'])) {
    $username_button = true;
    $first_load = false;
    $second_load = true;
    
    $unpw_id = $base->prevent_injection(hdent($_GET['unpw']));
    $uncodes = Codes::get_codes_by_id($unpw_id);
    $un = UnPw::get_unpw_by_id($unpw_id);
    $pwun_id = $base->prevent_injection(hdent($_GET['pwun']));
    $pwcodes = Codes::get_codes_by_id($pwun_id);
    $pw = UnPw::get_unpw_by_id($pwun_id);
    $tracker = Login::get_login_by_id($un->login_id);
    $username = "";
    $passcode = get_passcode(get_pw($tracker->login_id));
    if ($_POST['submit_decode_username'] == 'hide') {
        $username = get_username($un);
        $username_button = false;
    } else {
        foreach ($uncodes as $uncd) {
            $username .= chr(Yekym::get_character(((hexdec(strrev($uncd->multiplier))) / $uncd->weight), ((hexdec(strrev($uncd->codex))) / $uncd->weight)));
        }
    }
    
} elseif (isset($_POST['submit_decode_passcode'])) {
    $pw_button = true;
    $first_load = false;
    $second_load = true;
    
    $pwun_id = (isset($_GET['pwun'])) ? $base->prevent_injection(hdent($_GET['pwun'])) : false;
    $pwcodes = Codes::get_codes_by_id($pwun_id);
    $pw = UnPw::get_unpw_by_id($pwun_id);
    $unpw_id = (isset($_GET['unpw'])) ? $base->prevent_injection(hdent($_GET['unpw'])) : false;
    $uncodes = Codes::get_codes_by_id($unpw_id);
    $un = UnPw::get_unpw_by_id($unpw_id);
    $tracker = Login::get_login_by_id($pw->login_id);
    $passcode = "";
    $username = get_username(get_un($tracker->login_id));
    if ($_POST['submit_decode_passcode'] == 'hide') {
        $passcode = get_passcode($pw);
        $pw_button = false;
    } else {
        foreach ($pwcodes as $pwcd) {
            $passcode .= chr(Yekym::get_character(((hexdec(strrev($pwcd->multiplier))) / $pwcd->weight), ((hexdec(strrev($pwcd->codex))) / $pwcd->weight)));
        }
    }
} elseif (isset($_POST['submit_show'])) {
    if ($_POST['submit_show'] == 'Close') {
        redirect_to(TRACKER . "show_tracker.php");
    }
} else {


    $alpha = true;
    if (isset($_GET['alpha'])) {
        if ($_GET['alpha'] === 'true') {
            $alpha = true;
        } else {
            $alpha = false;
        }
    }
    $logins = Login::get_all_logins($user->user_id, $alpha);
}
if (isset($_GET['lid'])) {
    $lid = $base->prevent_injection(hent(ucode($_GET['lid'])));
    $log_user = Login::get_login_by_id($lid);
}
   ?>

<?php include_layout_template('jcs_header.php'); ?>
<?php if ($first_load && !$second_load) { ?>
<div class="grid container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			<?php show_how_many($howmany); ?>
		</div>
		<div class="large-6 medium-6 cell">
			<?php open_form($form_file); ?>
			<label for="select_tracker">
			<a href="<?php echo $form_file;?>?alpha=<?php if ($alpha) { echo 'false'; } else { echo 'true'; } ?>"><?php if ($alpha) { ?>Order by Number<?php } else { ?>Order Aphabetically<?php } ?></a><br>
			Choose Tracker
    			<select name="select_tracker" id="select_tracker" required>
    				<option value="">Select a Tracker <?php if ($alpha) { ?>(Alphabetical by name)<?php } else { ?>(By Number)<?php } ?></option>
           		<?php foreach ($logins as $login) { ?>
             		<option value="<?php echo $login->login_id; ?>"><?php echo $login->id . ") " . $login->descript; ?></option>
             		<?php } ?>
    			</select>
			</label>
			<div class="text-center">
				<input type="submit" class="button" name="submit_tracker" id="submit_tracker" value="Execute">
			</div>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>
<?php } elseif (!$first_load && $second_load) { ?>
<div class="grid containter">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3">
			<?php show_how_many($howmany); ?>
		</div>
		<div class="large-6 medium-6">
			<?php open_form($form_file, '?unpw=' . $un->unpw_id, '&pwun='.$pw->unpw_id); ?>
			<h5 class="text-center"><?php if ($tracker->url != "#") { echo "<a href=\"" . $tracker->url . "\" target=\"_blank\">" . $tracker->descript . "</a>"; } else { echo $tracker->descript; } ?></h5>
<?php //if (isset($username)) { ?>
			<fieldset class="callout">
				<legend>Username</legend>
    			<label for="area_username">
    				<textarea name="area_username" id="area_username" rows="5" readonly><?php echo $username; ?></textarea>
    			</label>
    			<div class="text-center"><input type="submit" name="submit_decode_username" id="submit_decode_username" value="<?php if ($username_button) { ?>hide<?php } else { ?>decode<?php } ?>"></div>
 			</fieldset>
<?php //} ?>
<?php //if (isset($passcode)) { ?>
				<fieldset class="callout">
				<legend>Passcode</legend>
    			<label for="area_passcode">
    				<textarea name="area_passcode" id="area_passcode" rows="6" readonly><?php echo $passcode; ?></textarea>
    			</label>
    			<div class="text-center"><input type="submit" name="submit_decode_passcode" id="submit_decode_passcode" value="<?php if ($pw_button) { ?>hide<?php } else { ?>decode<?php } ?>"></div>
 			</fieldset>
<?php //} ?>
			<div class="text-center">
				<input type="submit" class="button" name="submit_show" id="submit_show" value="Close">
			</div>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3">
			&nbsp;
		</div>
	</div>
</div>

<?php } ?>



<?php include_layout_template('jcs_footer.php'); ?>
