<?php
require_once '../../includes/initialize.php';
$menu_type = Menu_Type::get_by_type(CO_ABBR, 9);
$subtitle = "Welcome to ".CO_ABBR." Home Page";

if (!$session->is_logged_in()) { redirect_to(ADMIN_PATH.'login.php'); }
?>

<?php include_layout_template('jcs_header.php'); ?>
You have reached the Admin index page!



<?php include_layout_template('jcs_footer.php'); ?>

