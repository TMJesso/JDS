<?php
// Personal Information
require_once '../../../../includes/initialize.php';
$menu_type = Menu_Type::get_by_type("R&amp;eacute;sum&amp;eacute;", 9);
$user = User::get_user_by_username($session->get_user_id());
$user_id = $user->user_id;
unset($user);
$load = true;
$loader = true;
if (isset($_POST["submit_select_resume"])) { // info submit select resume
	$load = false;
	$loader = true;
	$r_id = $_POST["select_resume"];
	if ($r_id == "new") {
		$resume = new Resume();
		$resume->r_id = $r_id;
	} else {
		$resume = Resume::find_by_id($r_id);
	}
	$user = User_Detail::get_details_by_user_id($user_id);
	$resumes = Resume::get_all_resume_by_user_id($user_id);
} elseif (isset($_POST["submit_resume_details"])) { // info submit resume details
	if (isset($_GET["rid"])) {
		$r_id = $base->prevent_injection(hent($_GET["rid"]));
	} else {
		$r_id = $_POST["hidden_rid"];
	}
	if ($r_id == "new") {
		$resume = new Resume();
		$resume->r_id = get_new_id();
		$resume->user_id = $user_id;
		$resume->name = $base->prevent_injection(hent($_POST["txt_name"]));
		$resume->visible = $base->prevent_injection(hent($_POST["select_visible"]));
		$resume->position = $base->prevent_injection(hent($_POST["select_position"]));
	} else {
		$resume = Resume::find_by_id($r_id);
		$resume->name = $base->prevent_injection(hent($_POST["txt_name"]));
		$resume->visible = $base->prevent_injection(hent($_POST["select_visible"]));
		$resume->position = $base->prevent_injection(hent($_POST["select_position"]));
	}
	if ($save_results = $resume->save()) {
		if (is_array($save_results)) {
			$session->errors($save_results);
		} else {
			$session->message((($r_id == 'new') ? "New ": "") . "R&eacute;sum&eacute; <underline>" . hdent($resume->name) . "</underline> has been " . (($r_id == "new") ? "added!" : "updated!") . $save_results);
		}
	}
	redirect_to(RESUME . 'pinfo.php');
} elseif (isset($_POST["submit_delete"])) { // info submit delete
	$r_id = $base->prevent_injection(hent($_POST["hidden_rid"]));
	$delete_resume = Resume::find_by_id($r_id);
	if ($delete_resume->delete()) {
		$session->message("R&eacute;sum&eacute; <underline>" . hdent($delete_resume->name) . "</underline> has been removed!");
	}
	redirect_to(RESUME . 'pinfo.php');
} elseif(isset($_POST["submit_personal"])) {// info submit personal
	$rid = get_hidden_rid();
	
	redirect_to(RESUME . 'personal.php?rid='.$rid);
} elseif(isset($_POST["submit_objective"])) {// info submit objective
	$rid = get_hidden_rid();
	
	redirect_to(RESUME . '.php?rid='.$rid);
} elseif(isset($_POST["submit_educate"])) { // info submit educate
	$rid = get_hidden_rid();
	
	redirect_to(RESUME . '.php?rid='.$rid);
} elseif(isset($_POST["submit_experience"])) { // info submit experience
	$rid = get_hidden_rid();
	
	redirect_to(RESUME . '.php?rid='.$rid);
} elseif(isset($_POST["submit_skill"])) { // info submit skill
	$rid = get_hidden_rid();
	
	redirect_to(RESUME . '.php?rid='.$rid);
} elseif(isset($_POST["submit_awards"])) { // info submit awards
	$rid = get_hidden_rid();
	
	redirect_to(RESUME . '.php?rid='.$rid);
} elseif(isset($_POST["submit_hobby"])) { // submit hobby
	$rid = get_hidden_rid();
	
	redirect_to(RESUME . '.php?rid='.$rid);
} elseif(isset($_POST["submit_refer"])) { // submit refer
	$rid = get_hidden_rid();
	
	redirect_to(RESUME . '.php?rid='.$rid);
} else { // info otherwise 
	$resumes = Resume::get_all_resume_by_user_id($user_id);
}
?>
<?php include_layout_template('jcs_header.php'); ?>
<?php show_title("Add / Edit R&eacute;sum&eacute;"); ?>
<?php if ($load && $loader) { // info choose resume;?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<?php open_form("pinfo.php"); ?>
				<label for="select_resume">R&eacute;sum&eacute; Name (V - Visible
				&mdash;&mdash; NV - Not Visible) <select name="select_resume"
				id="select_resume" required>
					<option value="">Choose a R&eacute;sum&eacute; to Edit</option>
					<option value="new">Add New R&eacute;sum&eacute;</option>
						<?php foreach ($resumes as $res) { ?>
						<option value="<?php echo $res->r_id; ?>"><?php echo hdent($res->name); if ($res->visible) { echo " (V)"; } else { echo " (NV)"; } ?></option>
						<?php } ?>
					</select> <span class="form-error"> Please choose a Resume to Edit
					or Add New R&eacute;sum&eacute; </span>
			</label>
			<div class="text-center">
				<input type="submit" name="submit_select_resume"
					id="submit_select_resume" class="button" value="Submit"> <a
					href="<?php echo RESUME . "pinfo.php"; ?>" class="button">Cancel</a>
			</div>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>
<?php } else { // info name ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<?php open_form("pinfo.php"); ?>
				<input type="hidden" name="hidden_rid"
				value="<?php echo $resume->r_id; ?>">
			<fieldset class="callout">
				<legend>R&eacute;sum&eacute; for <?php echo $user->get_fullname(); ?></legend>
				<!-- Name -->
				<label for="txt_name">Name for this R&eacute;sum&eacute; <input
					type="text" name="txt_name" id="txt_name"
					value="<?php echo $resume->name; ?>" required> <span
					class="form-error"> Please enter the Name for this
						r&eacute;sum&eacute;. </span>
				</label>
				<!-- Visible -->
				<label for="select_visible">Make this R&eacute;sum&eacute; visible?
					(V - Visible &mdash;&mdash; NV - Not Visible) <select
					name="select_visible" id="select_visible" required>
						<option value="">Choose Visibility</option>
						<option value="1"
							<?php if ( $resume->visible && has_presence($resume->visible)) { ?>
							selected <?php } ?>>Visible</option>
						<option value="0"
							<?php if (!$resume->visible && has_presence($resume->visible)) { ?>
							selected <?php } ?>>Not Visible</option>
				</select> <span class="form-error"> Please choose whether this
						R&eacute;sum&eacute; is Visible or Not Visible </span>
				</label>
				<!-- Position -->

				<label for="select_position">When should this R&eacute;sum&eacute;
					appear in reports? <select name="select_position"
					id="select_position" required>
						<option value="">Choose Position</option>
						<?php for ($x = 0; $x <= 99; $x++) { ?>
						<option value="<?php echo $x;?>"
							<?php if ($resume->position == $x && has_presence($resume->position)) { ?>
							selected disabled <?php } ?>>
							<?php $msg = ""; ?>
							<?php foreach ($resumes as $res) { ?>
								<?php if ($res->position == $x) { ?>
									<?php $msg = " used by " . hdent($res->name);?>
								<?php } ?>
							<?php } ?>
							<?php echo $x . ".".$msg; ?></option>
						<?php } ?>
					</select> <span class="form-error"> Please choose the position you
						want this r&eacute;sum&eacute; in </span>
				</label>
			</fieldset>
			<!-- Buttons -->
			<div class="text-center">
				<input type="submit" class="button" name="submit_resume_details"
					id="submit_resume_details"
					value="<?php if ($r_id == "new") { echo "Save"; } else { echo "Update"; } ?>">
				<input type="reset" class="button" id="reset_resume_details"
					value="Reset">
					<?php if ($r_id != "new") { ?>
					<input type="submit" class="button" name="submit_delete"
					id="submit_delete" value="Delete"
					onclick="return confirm('Do you want to permanently remove <?php echo hdent($resume->name); ?> and all data associated with it?');">
					<?php } ?>
					 <a href="<?php echo RESUME . "pinfo.php"; ?>" class="button">Cancel</a>
			</div>
			<?php if ($r_id != "new") { ?>
			<fieldset class="callout">
				<legend>Add to my R&eacute;sum&eacute;</legend>
				<div class="text-center">
					<input type="submit" class="button secondary" name="submit_personal" id="submit_personal" value="Personal">
					<input type="submit" class="button secondary" name="submit_objective" id="submit_objective" value="Objective">
					<input type="submit" class="button secondary" name="submit_educate" id="submit_educate" value="Education">
					<input type="submit" class="button secondary" name="submit_experience" id="submit_experience" value="Experience"><br><hr><br>
					<input type="submit" class="button secondary" name="submit_skill" id="submit_skill" value="Skills">
					<input type="submit" class="button secondary" name="submit_awards" id="submit_awards" value="Awards">
					<input type="submit" class="button secondary" name="submit_hobby" id="submit_hobby" value="Hobbies">
					<input type="submit" class="button secondary" name="submit_refer" id="submit_refer" value="References">
				</div>
			</fieldset>
			<?php } ?>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>
<?php } ?>
<?php include_layout_template('jcs_footer.php'); ?>

<?php 
function get_hidden_rid() {
	global $base;
	return $base->prevent_injection(hent($_POST["hidden_rid"]));
}



?>