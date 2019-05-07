<?php
require_once '../../includes/initialize.php';
$load = false;
if (isset($_POST["submit_save"])) {
    $username = trim($base->prevent_injection(hent($_POST["txt_username"])));
    $password = trim($base->prevent_injection(hent($_POST["txt_passcode"])));
    $passcode = password_encrypt($username . $password);
    $security = $_POST["select_security"];
    $clearance = $_POST["select_clearance"];
    $user_id = $_POST["hidden_userid"];
    if (empty($user_id)) { 
        $user = User::get_user_by_user_id($user_id);
    } else {
        $user = new User();
        $user->user_id = get_new_id();
    }
    $user->username = $username;
    $user->passcode = $passcode;
    $user->security = $security;
    $user->clearance = $clearance;
    $user->changepass = 0;
    if ($user->save()) {
        $message = $username . " was successfully saved!";
        $session->message($message);
    } else {
        $errors = array($username . "was NOT saved!");
        $session->errors($errors);
    }
    redirect_to('add_user.php');
    
} elseif (isset($_POST["submit_choose"])) {
    $load = true;
    $user_id = $_POST["select_user"];
    if ($user_id == "new") {
        $user = new User();
    } else {
        $user = User::get_user_by_user_id($user_id);
    }
} else {
    $users = User::get_all_users();
}
?>
<?php include_layout_template('jcs_header.php'); ?>
<?php if ($load) { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<form data-abide novalidate method="post" action="add_user.php">
				<div data-abide-error class="alert callout" style="display: none;">
					<p>
						<i class="fi-alert"></i> Please scroll down to view all errors on form if necessary.
					</p>
				</div>
				<input type="hidden" name="hidden_userid" value="<?php echo $user->user_id; ?>" >
				<label for="txt_username">Username
					<input type="text" name="txt_username" id="txt_username" value="<?php echo $user->username; ?>" placeholder="Case sensitive and must be between 8 and 50 characters" required>
					<span class="form-error">
						You must enter the username...
					</span>
				</label>
				<label for="txt_passcode">Password
					<input type="password" name="txt_passcode" id="txt_passcode" value="" placeholder="Case sensitive. Upper, lower, number and at least 8 characters" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required >
					<span class="form-error">
						Password is case sensitive and must be at least 8 characters and contain an uppercase, lowercase, and a number...
					</span>
				</label>
				
				<label for="select_security">Security
					<select name="select_security" id="select_security" required>
						<option value="">Choose the security level for this user</option>
						<?php for ($x = 0; $x <= 9; $x++) { ?>
						<option value="<?php echo $x; ?>"<?php if ($user->security == $x) { ?>selected <?php } ?>><?php echo $x . ". " . get_security_text($x);?></option>
						<?php } ?>
					</select>
					<span class="form-error">
						Choose a security level for this user...
					</span>
				</label>
				
				<label for="select_clearance">Clearance
					<select name="select_clearance" id="select_clearance" required>
						<option value="">Choose the clearance level for this user</option>
						<?php for ($x = 0; $x <= 9; $x++) { ?>
						<option value="<?php echo $x; ?>" <?php if ($user->clearance == $x) { ?>selected <?php } ?>><?php echo $x . ". " . get_clearance_text($x); ?></option>
						<?php } ?>
					</select>
					<span class="form-error">
						Choose a clearance level for this user
					</span>
				</label>
				<div class="text-center">
					<input type="submit" name="submit_save" id="submit_save" class="button" value="Save">
				</div>
			</form>
		
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>
<?php } else { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			<form data-abide novalidate method="post" action="add_user.php">
				<div data-abide-error class="alert callout" style="display: none;">
					<p>
						<i class="fi-alert"></i> Please scroll down to view all errors on form if necessary.
					</p>
				</div>
				<label for="select_user">Choose a user or New
					<select name="select_user" id="select_user" required>
						<option value="">Choose a user to edit</option>
						<option value="new">Add new user</option>
						<?php foreach ($users as $user) { ?>
						<option value="<?php echo $user->user_id; ?>"><?php echo $user->username; ?></option>
						<?php } ?>
					</select>
				</label>
				
				<div class="text-center">
					<input type="submit" name="submit_choose" id="submit_choose" class="button" value="Go">
				</div>
			</form>		
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>
<?php } ?>
<?php include_layout_template('jcs_footer.php'); ?>