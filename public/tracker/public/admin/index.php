<?php
require_once '../../../../includes/initialize.php';
$menu_type = Menu_Type::get_by_type("Tracker", 9);
$subtitle = "Welcome to " . CO_ABBR . " Password Tracker";

?>
<?php include_layout_template('jcs_header.php'); ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-12 medium-12 cell">
			<div class="text-center">
				You have reached the Admin index for Tracker!
			</div>
 			
		</div>
	</div>
</div>



<?php include_layout_template('jcs_footer.php'); ?>
