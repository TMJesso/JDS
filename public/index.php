<?php
require_once '../includes/initialize.php';
if ($session->is_logged_in()) { if ($session->get_user_id() != "Public") { $session->logout(); $user = User::get_user_by_username("Public"); $session->login($user); } } else { $user = User::get_user_by_username("Public"); $session->login($user); }
?>
<?php include_layout_template('jcs_header.php'); ?>
<!-- Body -->
You have reached the Public index page!
<!-- Body: END -->
<?php include_layout_template('jcs_footer.php'); ?>
