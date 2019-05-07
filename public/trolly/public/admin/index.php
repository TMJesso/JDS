<?php
require_once '../../../../includes/initialize.php';
if (!$session->is_logged_in()) { redirect_to(ADMIN_PATH.'login.php'); }
$menu_type = Menu_Type::get_by_type("Trolley", 9);
$subtitle = "Welcome to JCS Trolley System";

// $menu_type = Menu_Type::get_by_type("JCS", 9);

?>
<?php include_layout_template('jcs_header.php'); ?>
You have reached the public index for City Line!



<?php include_layout_template('jcs_footer.php'); ?>
