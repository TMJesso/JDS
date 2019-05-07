<?php
require_once '../../../../includes/initialize.php';
$menu_type = Menu_Type::get_by_type("CLAD", 9);
$subtitle = "Welcome to the Change Log and Application Development log";
?>
<?php include_layout_template('jcs_header.php'); ?>
You have reached the admin index for CLAD!



<?php include_layout_template('jcs_footer.php'); ?>
