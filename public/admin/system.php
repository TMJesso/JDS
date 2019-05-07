<?php
require_once '../../includes/initialize.php';
if (!$session->is_logged_in()) { redirect_to(ADMIN_PATH.'login.php'); }


?>
<?php include_layout_template('jcs_header.php'); ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-12 medium-12 cell">
			<h3 class="text-center">System</h3>
		</div>
	</div>
</div>

<?php include_layout_template('jcs_footer.php'); ?>
