<?php
require_once '../../includes/initialize.php';

if (isset($_POST["submit_button"])) {
    $menu_type = new Menu_Type();
    $menu_type->security = $_POST["select_security"];
    $menu_type->clearance = $_POST["select_clearance"];
    $menu_type->type_id = get_new_id();
    $menu_type->m_type = $base->prevent_injection(hent($_POST["txt_type"]));
    $menu_type->visible = $_POST["select_visible"];
    $menu_type->type_order = $_POST["select_type_order"];
    if ($menu_type->save()) {
        $message = hdent($menu_type->m_type) . " was successfully added!";
        $session->message($message);
    } else {
        $errors = array("{$menu_type->m_type} could not be saved!");
        $session->errors($errors);
    }
    redirect_to('menu_type.php');
} else {
    $used_orders = Menu_Type::get_all_type_by_order();
}
?>
<?php include_layout_template('jcs_header.php'); ?>
<?php show_title("Add / Edit Menu Types"); ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
            <form data-abide novalidate method="post" action="menu_type.php">
                <div data-abide-error class="alert callout" style="display: none;">
                	<p><i class="fi-alert"></i> Please scroll down to view all errors on form.</p>
                </div>
<!-- Menu Type -->
                <label for="txt_type">Menu Type
                <input type="text" name="txt_type" id="txt_type" maxlength="25" placeholder="Maximum of 15 characters Must be unique" required autofocus>
                <span class="form-error">
                	You must enter the Menu Type example JDS or Tracker
                </span>
                </label>
                
<!-- Visibility -->
                <label for="select_visible">Visibility
                <select name="select_visible" id="select_visible" required>
                	<option value="" selected>Is it visible?</option>
                	<option value="0">Not Visible</option>
                	<option value="1">Visible</option>
                </select>
                <span class="form-error">
                	You must choose whether this menu is visible or not visible
                </span>
                </label>
<!-- Order -->
                <label for="select_type_order">Order
                	<select name="select_type_order" id="select_type_order" required>
                		<option value="">Choose the order for this Menu Type</option>
                		<?php for ($x = 0; $x <= 25; $x++) { ?>
                			<?php $msg = ""; ?>
                			<?php foreach ($used_orders as $order) { ?>
                				<?php if ($order->type_order == $x) { ?>
                					<?php $msg = hdent($order->m_type); ?>
                				<?php } ?>
                			<?php } ?>
                		<option value="<?php echo $x; ?>"><?php echo $x; if (!empty($msg)) { echo " used by " . $msg; }?></option>
                		<?php } ?>
                	</select>
                </label>
<!-- Security -->
                <label for="select_security">Security
                <select name="select_security" id="select_security" required>
                	<option value="" selected>Select security value for this menu item</option>
                	<?php for ($x = 0; $x <= 9; $x++) { ?>
                	<option value="<?php echo $x; ?>"><?php echo $x . ". " . get_security_text($x); ?></option>
                	<?php } ?>
                </select>
                <span class="form-error">
                	You must select a Security Value
                </span>
                </label>
                
<!-- Clearance -->
                <label for="select_clearance">Clearance
                <select name="select_clearance" id="select_clearance" required>
                	<option value="" selected>Select clearance value for this menu item</option>
                	<?php for ($x = 0; $x <= 9; $x++) { ?>
                	<option value="<?php echo $x; ?>"><?php echo $x . ". " . get_clearance_text($x); ?></option>
                	<?php } ?>
                </select>
                <span class="form-error">
                	
                </span>
                </label>
                
<!-- Button -->
            	<div class="text-center">
            		<input type="submit" name="submit_button" value="Go" class="button" >
            	</div>
            </form>
    	</div>
    	<div class="large-3 medium-3 cell">
    		&nbsp;
    	</div>
	</div>
</div>


<?php include_layout_template('jcs_footer.php'); ?>
