<?php
require_once '../../../../includes/initialize.php';
if (!$session->is_logged_in()) { redirect_to('login.php'); }
$subtitle = "Welcome to JCS Vehichle Maintenance and Annual Summary log";
$menu_type = Menu_Type::get_by_type("VMAS", 9);

?>
<?php include_layout_template('jcs_header.php'); ?>
You have reached the index for VMAS!



<?php include_layout_template('jcs_footer.php'); ?>
