<?php
require_once '../../../../includes/initialize.php';
if (! $session->is_logged_in()) {
	redirect_to(ADMIN_PATH . 'login.php');
}
$menu_type = Menu_Type::get_by_type("Tracker", 9);
$subtitle = CO_ABBR . " Password Tracker";

$load_first = false;
$load_second = false;
$form_file = TRACKER . 'add_login.php';
$user = User::get_user_by_username($session->get_user_id());
$editing = false;
$edit_fields = false;
if (isset($_POST['submit_add_edit_button'])) {
	// ******************************************** //
	// ************* choose which one ************* //
	// ******************************************** //
	$load_first = true;
	$load_second = true;
	$details = User_Detail::get_details_by_user_id($user->user_id);
	$subtitle = "Login info for " . $details->get_fullname();
	$how_many = Login::howmany();
	if ($_POST['select_login'] === 'new') { // adding new record
		$editing = false;
		$edit_fields = true;
	} else { // editing existing record
		$editing = true;
		$edit_fields = true;
		$descript = Login::get_login_by_login_id(Login::find_max_id())->descript;
		$tk = Login::get_login_by_id($_POST['select_login']);

		$tkunw = UnPw::get_all_by_login_id($tk->login_id);
		$tkuncodes = Codes::get_codes_by_id($tkunw[1]->unpw_id);
		$tkpwcodes = Codes::get_codes_by_id($tkunw[0]->unpw_id);
		$username = "";
		$passcode = "";
		foreach ($tkuncodes as $un) {
			$usrstrrevmult = strrev($un->multiplier);
			$usrmulthex = hexdec($usrstrrevmult);
			$usrstrrevcodx = strrev($un->codex);
			$usrcodxhex = hexdec($usrstrrevcodx);
			$unyekym_code = Yekym::get_character(($usrmulthex / $un->weight), ($usrcodxhex / $un->weight));
			$username .= chr($unyekym_code);
			// $username .= $un->multiplier.$un->slt.$un->codex;
		}
		foreach ($tkpwcodes as $pw) {
			$pwstrrevmult = strrev($pw->multiplier);
			$pwmulthex = hexdec($pwstrrevmult);
			$pwstrrevcodx = strrev($pw->codex);
			$pwcodxhex = hexdec($pwstrrevcodx);
			$pwyekym_code = Yekym::get_character(($pwmulthex / $pw->weight), ($pwcodxhex / $pw->weight));
			$passcode .= chr($pwyekym_code);
			// $passcode .= $pw->multiplier.$pw->slt.$pw->codex;
		}
	}
} elseif (isset($_POST['submit_login'])) {

	if ($_POST['submit_login'] == 'Save') { // info adding new
	                                        // ******************************************** //
	                                        // ************* choose which one ************* //
	                                        // ******************************************** //
		$message = "";
		$pw = trim($_POST['area_pass']);
		$ur = $base->prevent_injection(trim($_POST['txt_username']));
		$this_txt = "";
		$edit_fields = true;
		$editing = true;
		if (isset($_GET['unpw']) && isset($_GET['pwun'])) {
			$un_id = hent(ucode($_GET['unpw']));
			$temp = UnPw::get_unpw_by_id($un_id);
			$unpw = UnPw::get_all_by_login_id($temp->login_id);
			$message = "";
			$temp_un = $base->prevent_injection(hent($_POST['txt_username']));
			$temp_pw = $base->prevent_injection(hent($_POST['area_pass']));
			// var_dump($unpw);
			// return;
			foreach ($unpw as $up) {
				// info

				if ($up->user_pass) {
					$message .= "Passcode";
					$this_txt = $temp_pw;
				} else {
					$message .= "Username";
					$this_txt = $temp_un;
				}

				// info function call to generate code
				generate_secret_code($this_txt, $up);
				// $session->message($message);
			}

			$login = Login::get_login_by_id($temp->login_id);
			$login->descript = $base->prevent_injection(hent($_POST['txt_descript']));
			$login->url = $base->prevent_injection(hent($_POST['txt_url']));
			if ($login->save()) {
				$message .= "Descript: " . $login->descript . " has been updated!<br>";
				$message .= "And URL: " . $login->url . " has been updated!";
			}
		} else {

			$login = new Login();
			$login->login_id = get_new_id();
		}
		$login->user_id = $user->user_id;
		$login->descript = $base->prevent_injection(hent(trim($_POST['txt_descript'])));
		$login->url = $base->prevent_injection(hent(trim($_POST['txt_url'])));
		if ($login->save()) {
			$message .= "Login data saved for<br>" . hdent($login->descript) . "!<br>";
			for ($x = 0; $x <= 1; $x ++) {
				$unpw = new UnPw();
				$unpw->unpw_id = get_new_id();
				$unpw->login_id = $login->login_id;
				// 0 is username and 1 is passcode
				$unpw->user_pass = $x;

				if ($unpw->save()) {
					$message .= "UNPW data saved for<br>";
					if ($x == 0) {
						$message .= "Username";
						$this_txt = $ur;
					} else {
						$message .= "Passcode";
						$this_txt = $pw;
					}
					$message .= "!<br>";
					// info function call to generate code
					generate_secret_code($this_txt, $unpw);
				} else {
					$message .= "UNPW data was NOT saved!";
				}
				$message .= "<br><br>";
			}
		} else {
			$message .= "Login info was NOT saved!";
			$message .= "<br><br>";
		}
		$session->message($message);
		redirect_to(TRACKER . 'add_login.php');
	} elseif ($_POST['submit_login'] == 'Edit') {
		// ******************************************* //
		// ***************** editing ***************** //
		// ******************************************* //
		$editing = true;
		$edit_fields = false;
		$load_first = true;
		$load_second = true;
		$how_many = Login::howmany();

		$pwun_id = $base->prevent_injection(hent($_GET['unpw'])); // username
		$unpw_id = $base->prevent_injection(hent($_GET['pwun'])); // passcode

		$un_info = UnPw::get_unpw_by_id($pwun_id);
		$pw_info = UnPw::get_unpw_by_id($unpw_id);

		$uncodes = Codes::get_codes_by_id($unpw_id);
		$pwcodes = Codes::get_codes_by_id($pwun_id);
		$proceedu = false;
		$proceedp = false;
		$backedun = CodeB::copy_codes_by_id($pwun_id);
		if ($backedun) {
			$codes = Codes::delete_all_codes_for_unpw_id($pwun_id);
			if ($codes) {
				$message .= "Login Codes for 'Username'";
				$proceedu = true;
			}
			$message .= " are being prepared for edited information!<br>";
		}
		$backedpw = CodeB::copy_codes_by_id($unpw_id);
		if ($backedpw) {
			$codes = Codes::delete_all_codes_for_unpw_id($unpw_id);
			if ($codes) {
				$message .= "Login Codes for 'Passcode'";
				$proceedp = true;
			}
			$message .= " are being prepared for edited information!<br>";
		}
		$username = "";
		$passcode = "";
		$descript = $base->prevent_injection(hent($_POST['txt_descript']));
		$url = $base->prevent_injection(hent($_POST['txt_url']));

		$txt_passcode = $base->prevent_injection(hent($_POST['area_pass']));
		$txt_username = $base->prevent_injection(hent($_POST['txt_username']));
		$username = $txt_username;
		$passcode = $txt_passcode;

		if ($proceedu) {
			generate_secret_code($txt_username, $un_info);
		} else {
			$errors = array(
				"Username" => "Unable to save username information!"
			);
		}
		if ($proceedp) {
			generate_secret_code($txt_passcode, $pw_info);
		} else {
			$errors = array(
				"Passcode" => "Unable to save passcode information!"
			);
		}
		$message .= "<br>";

		$login_id = UnPw::get_unpw_by_id($pwun_id)->login_id;
		$login = Login::get_login_by_id($login_id);
		$login->descript = $descript;
		$login->url = $url;
		if ($login->save()) {
			$message .= "Login info has been saved!!!!<br><br>";
			if (isset($errors)) {
				$session->errors($errors);
			}
			$session->message($message);
			redirect_to($form_file);
		}
	} elseif ($_POST['submit_login'] == 'Change') {}
} elseif (isset($_POST["submit_delete"])) { 
	
} elseif ($load_first) {
	
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

?>
<?php include_layout_template('jcs_header.php'); ?>
<?php if (!$load_first && !$load_second) { // initial page load ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<?php open_form($form_file); ?>
				<label for="select_login">Tracker <a
				href="<?php echo $form_file;?>?alpha=<?php if ($alpha) { echo 'false'; } else { echo 'true'; } ?>"><?php if ($alpha) { ?>Order by Number<?php } else { ?>Order Aphabetically<?php } ?></a><br>
				<select name="select_login" id="select_login" required>
					<option value="">Choose which Login to edit or Add New Login</option>
					<option value="new">Add New Login</option>
    					<?php foreach ($logins as $logs) { ?>
    					<option value="<?php echo $logs->login_id?>"><?php echo $logs->id; ?>) <?php echo $logs->descript; ?></option>
    					<?php } ?>
    				</select> <span class="form-error"> Please choose a Login to
					edit or select Add New Login </span>
			</label>

			<div class="text-center">
				<input type="submit" class="button" name="submit_add_edit_button"
					id="submit_add_edit_button" value="Go">
			</div>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>
<?php } elseif ($load_first && $load_second) { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
		<?php if ($how_many) { ?>
			<h5 class="text-center">Trackers: <?php echo $how_many; ?></h5>
			<?php if (isset($descript)) { ?>
			<div class="text-center">
				<?php echo $descript; ?>
			</div>
			<?php } ?>
		<?php } else { ?>
			&nbsp;
		<?php } ?>
		</div>
		<div class="large-6 medium-6 cell">
			<form data-abide novalidate method="post"
				action="<?php echo TRACKER; ?>add_login.php<?php if ($editing) { ?>?unpw=<?php echo $tkunw[1]->unpw_id; ?>&pwun=<?php echo $tkunw[0]->unpw_id; }?>">
				<div data-abide-error class="alert callout" style="display: none;">
					<p>
						<i class="fi-alert"></i> Please scroll down to view all errors on
						form.
					</p>
				</div>
				<!-- Description -->
				<label for="txt_descript">Description <input type="text"
					name="txt_descript" id="txt_descript" maxlength="75"
					placeholder="Description of Login! Max 75"
					value="<?php if (isset($tk)) { echo $tk->descript; } elseif (isset($descript)) { echo $descript; } ?>"
					required <?php if (!$edit_fields) { ?> readonly <?php } ?>> <span
					class="form-error"> You must enter the Description for this login!
				</span>
				</label>
				<!-- URL -->
				<label for="txt_url">URL <input type="text" name="txt_url"
					id="txt_url" maxlength="150"
					placeholder="URL of this login! Max 150" required
					value="<?php if (isset($tk)) { echo $tk->url; } elseif (isset($url)) { echo $url; } ?>"
					<?php if (!$edit_fields) { ?> readonly <?php } ?>> <span
					class="form-error"> If URL is not available at this time please
						place a # as a place holder. </span>
				</label>
				<!-- Username -->
				<label for="txt_username">Username <textarea rows="4"
						name="txt_username" id="txt_username"
						aria-describedby="area_user_help"
						placeholder="None for no username!" required
						<?php if (!$edit_fields) { ?> readonly <?php } ?>><?php if (isset($username)) { echo $username; } ?></textarea>
					<!-- 					<input type="text" name="txt_username" id="txt_username" maxlength="200" placeholder="None for no username! Max 200" value="" required> -->
					<span class="form-error"> You must enter a username for this login.
						Enter None if no username is used! </span>
				</label>
				<p class="help-text" id="area_user_help">If there is no username,
					enter None</p>
				<!-- Passcode -->
				<label for="area_pass">Passcode <textarea rows="4" name="area_pass"
						id="area_pass" aria-describedby="area_pass_help" required
						<?php if (!$edit_fields) { ?> readonly <?php } ?>><?php if (isset($passcode)) { echo $passcode; } ?></textarea>
					<span class="form-error"> You must enter a passcode! Use none if no
						passcode is used. </span>
				</label>
				<p class="help-text" id="area_pass_help">Invalid characters:
					(apostrophe) &#39;, (quotation mark) &quot;, (vertical line) |,
					&amp; (tilde) &#126;</p>
				<div class="text-center">
					<input type="submit" class="button" name="submit_login"
						id="submit_login"
						value="<?php if ($editing && !$edit_fields) { ?>Change<?php } elseif ($editing && $edit_fields) { ?>Edit<?php } else { ?>Save<?php } ?>">
					<input type="reset" class="button" name="reset_login"
						id="reset_login" value="Reset"> <a href="add_login.php"
						class="button">Cancel</a>
						<input type="submit" name="submit_delete" id="submit_delete" class="button" value="Delete">
				</div>
			</form>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>
<?php } elseif (!$load_first && $load_second) { ?>


<?php } ?>
<?php include_layout_template('jcs_footer.php'); ?>


<?php

function get_random_number()
{
	$loop = true;
	$n = null;
	while ($loop) {
		$n = get_random_value(32, 125);
		$loop = check_invalid_characters($n);
	}
	return $n;
}

function check_invalid_characters($letter = 0)
{
	switch ($letter) {
		case 34:
			return true;
		case 39:
			return true;
		case 96:
			return true;
		case 124:
			return true;
		case 126:
			return true;

		default:
			return false;
	}
}

function generate_secret_code($this_txt, $unpw)
{
	global $message;
	$a = 0;
	// echo $this_txt;
	$save_codes = array();
	for ($y = 0; $y < strlen($this_txt); $y ++) {
		$my_chr = substr($this_txt, $y, 1);
		if (check_invalid_characters(ord($my_chr))) {
			continue;
		}
		$codes = new Codes();
		$codes->np = 0;
		$codes->gen_salt(12);
		$codes->codes_id = get_new_id();
		$codes->unpw_id = $unpw->unpw_id;
		$weight = get_random_value(2, 9);
		$x_value = get_random_number();
		// $y_value = get_random_number();
		$multdechex = dechex($weight * $x_value);
		$codes->multiplier = strrev($multdechex);
		$str_value = Yekym::generate_code($x_value, $my_chr);
		$weight_ord = $weight * ord($str_value);
		$hex_weight = dechex($weight_ord);
		$codes->codex = strrev($hex_weight);
		$weight_hex = dechex($weight);
		$codes->weight = strrev($weight_hex);
		$codes->code_order = $a;
		$a ++;
		$save_codes[] = $codes->save();
	}
	$count_saved = true;
	for ($y = 0; $y < count($save_codes); $y ++) {
		if ($save_codes[$y] == 0) {
			$count_saved = false;
		}
	}
	if ($count_saved) {
		$message .= "All characters have been encrypted!<br>";
	} else {
		$message .= "Not all characters have been encrypted!<br>";
	}
}

?>
