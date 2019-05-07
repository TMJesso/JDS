<?php
require_once '../../includes/initialize.php';

$thisPage = "Admin Login";
if (isset($_POST["submit_login"])) {
    $username = trim($base->prevent_injection(hent($_POST["txt_username"])));
    $password = trim($base->prevent_injection(hent($_POST["txt_passcode"])));
    $user = User::get_user_by_username($username);
    if ($user) {
        if (password_check($username.$password, $user->passcode)) {
            $session->login($user);
            redirect_to('index.php');
        } else {
            $errors = array("Username and/or password did not match any in our system!");
            $session->errors($errors);
            redirect_to('login.php');
        }
    } else {
        $errors = array("Username and/or password did not match any in our system!");
        $session->errors($errors);
        redirect_to('login.php');
    }
}
?>
<?php include_layout_template('jcs_login_header.php'); ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<form data-abide novalidate method="post" action="login.php">
				<div data-abide-error class="alert callout" style="display: none;">
					<p>
						<i class="fi-alert"></i> Please scroll down to view all errors on form if necessary.
					</p>
				</div>
				<label for="txt_username">Username
					<input type="text" name="txt_username" id="txt_username" value="" autofocus placeholder="Case sensitive and must be between 8 and 50 characters" required>
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
				
				<div class="text-center">
					<input type="submit" name="submit_login" id="submit_login" class="button" value="Login">
				</div>
			</form>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>



<?php include_layout_template('jcs_footer.php'); ?>