<?php
require_once '../../includes/initialize.php';
if (! $session->is_logged_in()) {
	redirect_to(ADMIN_PATH . 'login.php');
}

$load = true;
$loadin = true;
$loadout = true;
// info beginning 
if (isset($_POST["submit_type"]) || (isset($_GET["tid"]) && ! isset($_POST["submit_menu"]) && ! isset($_POST["submit_addmenu"]) && ! isset($_POST["submit_delete"]))) {
	$load = false;
	$loadin = true;
	$loadout = true;
	$type_id = "";
	if (isset($_POST["submit_type"])) {
		$type_id = $_POST["select_menu_type"];
		$current_type = Menu_type::get_all_type_by_order();
		if ($type_id == 'new') {
			$load = true;
			$loadin = false;
			$loadout = true;
			$mymenu_type = new Menu_Type();
			$mymenu_type->type_id = $type_id;
		} else {
			$load = true;
			$loadin = false;
			$loadout = false;
			$mymenu_type = Menu_Type::get_by_type_id($type_id);
		}
	} elseif (isset($_GET["tid"])) {
		$type_id = $base->prevent_injection(hent($_GET["tid"]));
	}
	$menus = Menu::get_all_menus_by_type_id($type_id);
} elseif (isset($_POST["submit_menu"])) { // info submit_menu
	$load = false;
	$loadin = false;
	$loadout = true;
	$type_id = ucode($_GET["tid"]);
	$menu_id = $_POST["select_menu"];
	if ($menu_id == 'new') {
		$this_menu = new Menu();
		$this_menu->m_id = get_new_id();
		$this_menu->type_id = $type_id;
		$this_menu->m_order = - 1;
	} elseif ($menu_id == 'sub') {
		redirect_to('add_submenu.php?tid=' . $type_id);
	} else {
		$this_menu = Menu::get_menu_by_m_id($menu_id);
	}
	$menus = Menu::get_all_menus_by_type_id($type_id);
} elseif (isset($_POST["submit_addmenu"])) { // info submit_addmenu 
	// user clicked 'Go' to save it
	$type_id = $base->prevent_injection(hent(ucode($_GET["tid"])));
	$menu_id = $base->prevent_injection(hent(ucode($_GET["mid"])));
	if ($menu_id == "new") {
		$this_menu = new Menu();
		$this_menu->m_id = get_new_id();
		$this_menu->type_id = $type_id;
	} else {
		$this_menu = Menu::get_menu_by_m_id($menu_id);
	}
	$this_menu->name = $base->prevent_injection(hent($_POST["txt_name"]));
	$this_menu->m_path = $base->prevent_injection(hent($_POST["txt_m_path"]));
	$this_menu->m_url = $base->prevent_injection(hent($_POST["txt_m_url"]));
	$this_menu->m_order = $_POST["select_order"];
	$this_menu->visible = $_POST["select_visible"];
	$this_menu->security = $_POST["select_security"];
	$this_menu->clearance = $_POST["select_clearance"];
	if ($this_results = $this_menu->save()) {
		if (is_array($this_results)) {
			$session->errors($this_results);
		} else {
			$session->message(hdent($this_menu->name).$this_results);
		}
	}
	redirect_to("add_menu.php");
} elseif (isset($_POST["submit_delete"])) { // info submit_delete
	// delete menu item
	// echo $_GET["tid"] . " :: " . $_GET["mid"];
	$load = true;
	$loadin = true;
	$loadout = true;
	$m_id = $base->prevent_injection(hent($_GET["mid"]));
	$t_id = $base->prevent_injection(hent($_GET["tid"]));
	$delete_menu = Menu::get_menu_by_m_id($m_id);
	if ($delete_menu->type_id == $t_id) { // proof the type_id and the m_id are the same
		if ($delete_menu->delete()) {
			$message = "{$delete_menu->name} has been removed from the menus!";
			$delete_submenu = Tier1::get_all_submenu_by_menu_id($delete_menu->m_id);
			foreach ($delete_submenu as $ds) {
				if ($ds->delete()) {
					$message .= "<br><br>{$ds->name} has also been removed from the submenus!";
				}
			}
			$session->message($message);
		} else {
			$errors = array(
				"{$delete_menu->name} was NOT deleted!"
			);
			$session->errors($errors);
		}
		redirect_to('add_menu.php');
	}
} elseif (isset($_POST["button_submit_new_type"])) { // info button_submit_new_type
	// add new menu
	if ($_POST["hidden_type_id"] == "new") {
		$mymenu_type = new Menu_Type();
		$mymenu_type->type_id = get_new_id();
	} else {
		$mymenu_type = Menu_Type::get_by_type_id($_POST["hidden_type_id"]);
	}
	$mymenu_type->visible = $_POST["select_type_visible"];
	$mymenu_type->type_order = $_POST["select_type_order"];
	$mymenu_type->m_type = $base->prevent_injection(hent($_POST["txt_m_type"]));
	$mymenu_type->security = $_POST['select_type_security'];
	$mymenu_type->clearance = $_POST['select_type_clearance'];
	if ($this_results = $mymenu_type->save()) {
		if (is_array($this_results)) {
			$session->errors($this_results);
		} else {
			$session->message("New Mnue " . $mymenu_type->m_type . " has been " . ($_POST["hidden_type_id"] == "new" ? "added":"updated"));
		}
		redirect_to('add_menu.php');
	}
} elseif (isset($_POST["submit_type_delete"])) { // info submit_type_delete
	$load = true;
	$loadin = true;
	$loadout = true;
	$tid = $base->prevent_injection(hent($_GET["tid"]));
	$delete_type = Menu_Type::get_by_type_id($tid);
	$message = "";
	if ($delete_type->delete()) {
		$message = "Successfully removed {$delete_type->m_type}!<br>";
		$delete_menu = Menu::get_all_menus_by_type_id($delete_type->type_id);
		foreach ($delete_menu as $menu) {
			if ($menu->delete()) {
				$message .= "Also Menu {$menu->name} has also been removed!<br>";
				$delete_submenu = Tier1::get_all_submenu_by_menu_id($menu->m_id);
				foreach ($delete_submenu as $sub) {
					if ($sub->delete()) {
						$message .= "And Submenu of {$menu->name} - {$sub->name} has been removed!<br>";
					}
				}
			}
		}
	}
	$session->message($message);
	redirect_to('add_menu.php');
	
} else { // info END 
	// no other option was true

	$type_menu = Menu_Type::get_all_type_by_order();
}
?>

<?php include_layout_template('jcs_header.php'); ?>
<?php show_title("Add / Edit Menu"); // info choose logic ?>
<?php if ($load && $loadin && $loadout) {  // ttt choose menu type to add menu to ?>
	<?php show_menu_type($type_menu); ?>
<?php } elseif (!$load && !$loadin && $loadout) { // fft edit or add menu?>
	<?php addedit($type_id, $menu_id, $this_menu, $menus); ?>
<?php } elseif (!$load && $loadin && $loadout) { // ftt choose menu to edit or add new ?>
	<?php choose_menu_add_edit($type_id, $menus); ?>
<?php } elseif ($load && !$loadin && $loadout) { // tft add new menu type  ?>
	<?php add_new_menu_type($mymenu_type, $current_type); ?>
<?php } elseif ($load && !$loadin && !$loadout) { // tff edit menu type  ?>
	<?php add_new_menu_type($mymenu_type, $current_type); ?>
<?php } ?>
<?php include_layout_template('jcs_footer.php'); ?>


<?php function show_menu_type($type_menu) { // info show_menu_type ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<form data-abide novalidate method="post" action="add_menu.php">
				<div data-abide-error class="alert callout" style="display: none;">
					<p>
						<i class="fi-alert"></i> Please scroll down to view all errors on
						form.
					</p>
				</div>
				<label for="select_menu_type">Choose Menu Type<select
					name="select_menu_type" id="select_menu_type" required>
						<option value="">Select Menu Type to add a item or Add new Menu
							Type</option>
						<option value="new">Add new Menu Type</option>
    <?php foreach ($type_menu as $menu) { ?>
						<option value="<?php echo $menu->type_id; ?>"><?php echo hdent($menu->m_type); ?></option>
						<?php } ?>
					</select>
				</label>
				<div class="text-center">
					<?php get_submit_button('submit_type', 'Get It'); ?>
<!-- 					<input type="submit" name="submit_type" id="submit_type" class="button" value="Go"> -->
				</div>
			</form>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>


<?php
}

function addedit($type_id, $menu_id, $this_menu, $menus)
{ // info addedit
	?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">

			<form data-abide novalidate method="post"
				action="add_menu.php?tid=<?php echo $type_id;?>&mid=<?php echo $menu_id; ?>">
				<div data-abide-error class="alert callout" style="display: none;">
					<p>
						<i class="fi-alert"></i> Please scroll down to view all errors on
						form.
					</p>
				</div>
				<!-- Name -->
				<label for="txt_name">Name <input type="text" name="txt_name"
					id="txt_name" value="<?php echo hdent($this_menu->name); ?>"
					maxlength="20" placeholder="Maximum characters of 20" required> <span
					class="form-error"> You must enter the Name of this menu item </span>
				</label>
				<!-- PATH -->
				<label for ="txt_m_path">Path to Filename
					<input type="text" name="txt_m_path" id="txt_m_path" value="<?php echo hdent($this_menu->m_path); ?>" 
					placeholder="Maximum characters of 75" title="Path of the filename" required maxlength="75">
					<span class="form-error">
						Pleace enter the path for the Filename...
					</span>
				</label>
				<!-- URL -->
				<label for="txt_m_url">Filename (including extension) <input type="text" name="txt_m_url"
					id="txt_m_url" value="<?php echo $this_menu->m_url; ?>"
					maxlength="25" placeholder="Maximum characters of 25"
					required> <span class="form-error"> You must enter the URL for this
						menu item </span>
				</label>
				<!-- Order -->
				<label for="select_order">Order <select name="select_order"
					id="select_order" required>
						<option value="">Choose the order for this menu item</option>
						<?php for ($x = 0; $x <= 25; $x++) { ?>
    						<?php $msg = "{$x}. "; $msge = ""; ?>
						<option value="<?php echo $x; ?>"
							<?php if ($this_menu->m_order == $x) { ?> selected <?php } ?>>
							<?php foreach ($menus as $men) { ?>
    							<?php if ($men->m_order == $x) { ?>
    								<?php $msge = "used by " . hdent($men->name); ?>
    							<?php } ?>
    						<?php } ?>
							<?php echo $msg.$msge; $msge = "";?></option>
						<?php } ?>
					</select> <span class="form-error"> Please choose the order of this
						menu </span>
				</label>
				<!-- Visible -->
				<label for="select_visible">Visible <select name="select_visible"
					id="select_visible" required>
						<option value="">Choose visibility</option>
						<option value="0" <?php if ($this_menu->visible == 0) { ?>
							selected <?php } ?>>Not Visible</option>
						<option value="1" <?php if ($this_menu->visible == 1) { ?>
							selected <?php } ?>>Visible</option>
				</select> <span class="form-error"> You must choose whether this
						menu item is visible or not visible </span>
				</label>
				<!-- Security -->
				<label for="select_security">Security <select name="select_security"
					id="select_security" required>
						<option value="">Choose security value for this menu</option>
						<?php for ($x = 0; $x <= 9; $x++) { ?>
						<option value="<?php echo $x; ?>"
							<?php if ($x == $this_menu->security) { ?> selected <?php }?>><?php echo $x . ". " . get_security_text($x); ?></option>
						<?php } ?>
					</select>
				</label>
				<!-- Clearance -->
				<label>Clearance <select name="select_clearance"
					id="select_clearance" required>
						<option value="">Choose clearance value for this menu</option>
						<?php for ($x = 0; $x <= 9; $x++) { ?>
						<option value="<?php echo $x; ?>"
							<?php if ($this_menu->clearance == $x) { ?> selected <?php } ?>><?php echo $x . ". " . get_clearance_text($x); ?></option>
						<?php } ?>
					</select>
				</label>
				<div class="text-center">
					<?php get_submit_button('submit_addmenu', 'Save'); ?>
<!-- 					<input type="submit" name="submit_addmenu" class="button" value="Go"> -->
					<?php get_reset_button(); ?>
					<?php if ($menu_id != "new") { ?>
					<a href="add_submenu.php?mid=<?php echo $menu_id; ?>"
						class="button">Add / Edit Submenu</a> <input type="submit"
						name="submit_delete" class="button" value="Delete"
						onclick="return confirm('Are you sure you want to remove <?php echo $this_menu->name; ?>?');">
					<?php } ?>
					<?php get_cancel_button(); ?>
				</div>
			</form>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>

<?php

}

function choose_menu_add_edit($type_id, $menus)
{ // info choose_menu_add_edit 
	?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<form data-abide novalidate method="post"
				action="add_menu.php?tid=<?php echo $type_id;?>">
				<div data-abide-error class="alert callout" style="display: none;">
					<p>
						<i class="fi-alert"></i> Please scroll down to view all errors on
						form.
					</p>
				</div>
				<label for="select_menu">Choose Menu <select name="select_menu"
					id="select_menu" required>
						<option value="">Choose menu to edit or Add new menu</option>
						<option value="new">Add new menu</option>
                		<?php foreach ($menus as $menu) { ?>
                		<option value="<?php echo $menu->m_id;?>"><?php echo $menu->m_order . ". " . hdent($menu->name) . " :sec: " . $menu->security . " :clr: " . $menu->clearance; ?></option>
                		<?php } ?>
                	</select>
				</label>
				<div class="text-center">
                	<?php get_submit_button('submit_menu', 'Get This');?>
                	<?php get_cancel_button(); ?>
                </div>
			</form>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>

<?php

}

function add_new_menu_type($mymenu_type, $current_type)
{ // info add_new_menu_type 
	?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">&nbsp;</div>
		<div class="large-6 medium-6 cell">
			<h5 class="text-center"><?php if ($mymenu_type->type_id == 'new') { ?>Add New <?php } else { ?>Edit <?php } ?>Menu Type</h5>
			<?php open_form('add_menu.php', ($mymenu_type->type_id == 'new'? '' : '?tid='.$mymenu_type->type_id)); ?>
				<input type="hidden" name="hidden_type_id"
				value="<?php echo $mymenu_type->type_id;?>">
			<!-- Menu Type -->
			<label for="txt_m_type">Menu Type <input type="text"
				name="txt_m_type" id="txt_m_type" maxlength="35"
				value="<?php echo hdent($mymenu_type->m_type); ?>" required /> <span
				class="form-error"> You must enter the Menu Type ... </span>
			</label>
			<!-- Order -->
			<label for="select_type_order">Order this will appear on menu <select
				name="select_type_order" id="select_type_order" required>
					<option value="">Choose the Order</option>
						<?php for ($z = 0; $z <= 25; $z++) { ?>
							
							<option value="<?php echo $z; ?>"
						<?php if ($z < count($current_type)) { if ($mymenu_type->type_order == $z) { ?>
						selected <?php }} ?>><?php echo $z; if ($z < count($current_type)) { if ($current_type[$z]->type_order == $z) { echo " (" . hdent($current_type[$z]->m_type) . ")"; } } ?></option>
						<?php } ?>
					</select>
			</label>
			<!-- Visibility -->
			<label for="select_type_visible">Visiblility <select
				name="select_type_visible" id="select_type_visible" required>
					<option value="">Choose visibility</option>
					<option value="0" <?php if ($mymenu_type->visible == 0) { ?>
						selected <?php } ?>>Not Visible</option>
					<option value="1" <?php if ($mymenu_type->visible == 1) { ?>
						selected <?php } ?>>Visible</option>
			</select>
			</label>
			<!-- Security -->
			<label for="select_type_security">Security <select
				name="select_type_security" id="select_type_security" required>
					<option value="">Select Security for this Menu Type</option>
						<?php for ($x = 0; $x <= 9; $x++) { ?>
							<option value="<?php echo $x; ?>"
						<?php if ($mymenu_type->security == $x) { ?> selected <?php } ?>><?php echo $x . ') ' . get_security_text($x); ?></option>
						<?php } ?>
					</select>
			</label>
			<!-- Clearance -->
			<label for="select_type_clearance">Clearance <select
				name="select_type_clearance" id="select_type_clearance" required>
					<option value="">Select Clearance for this Menu Type</option>
						<?php for ($y = 0; $y <= 9; $y++) { ?>
							<option value="<?php echo $y; ?>"
						<?php if ($mymenu_type->clearance == $y) { ?> selected <?php } ?>><?php echo $y . ') ' . get_clearance_text($y); ?></option>
						<?php } ?>
					</select>
			</label>
			<div class="text-center">
					<?php get_submit_button('button_submit_new_type', 'Save'); ?>
					<?php if ($mymenu_type->type_id != 'new') { ?>
					<?php get_submit_button('button_submit_menu', 'Add / Edit Menu')?>
					<input type="submit" name="submit_type_delete" class="button"
					value="Delete"
					onclick="return confirm('Are you sure you want to remove <?php echo $mymenu_type->m_type; ?>? All submenus will also be removed');">
					<?php } ?>
					<?php get_cancel_button('add_menu.php'); ?>
				</div>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3 cell">&nbsp;</div>
	</div>
</div>

<?php } ?>


<?php 
// Books I need to read

// The Marshmallow Test - by - Walter Mischel

// A Curious Mind - by - Brian Glazer

// Mindset - by - Carol Dweck

// Popular: The Power of Likability in a Status-Obsessed World - by - Mitch Prinstein

// Path to Purpose - by - William Damon










?>