<?php
require_once '../../../../includes/initialize.php';
$subtitle = "Add / Edit Stops";
$load_station = true;
$load_stop = false;

if (isset($_POST['button_submit_stop'])) {
    if (isset($_GET['stop'])) {
        // updating the stop
    } else { 
        $add_stop = new Stops();
        $add_stop->stops_id = get_new_id();
        $add_stop->st_id = $base->prevent_injection(hent($_GET['st_id']));
        $add_stop->description = $base->prevent_injection(hent($_POST['txt_descript']));
        $add_stop->address = $base->prevent_injection(hent($_POST['txt_address']));
        $add_stop->stop_time = $base->prevent_injection(hent($_POST['num_stop_time']));
        $add_stop->shelter = $base->prevent_injection(hent($_POST['select_shelter']));
        $add_stop->direction = $base->prevent_injection(hent($_POST['select_direction']));
        if ($add_stop->save()) {
            $session->message('Stop ' . $add_stop->description . ' was successfully saved');
            redirect_to('addedit_stops.php');
        } else {
            $errors = array("An error has occured. {$add_stop->description} was NOT saved!");
            $session->errors($errors);
            redirect_to('addedit_stops.php');
        }
    }
} elseif (isset($_POST['button_submit_station'])) {
    $load_station = true;
    $load_stop = true;
    $st_id = $_POST['select_station'];
    $stops = Stops::get_stop_by_st_id($st_id);
} elseif (isset($_POST['button_submit_edit_stops'])) { 
    $load_station = false;
    $load_stop = true;
    // TODO add functionality to load station id and if editing stop id
    
} else {
    $station = Station::get_all_stations_by_line();
}

?>

<?php include_layout_template('jcs_header.php'); ?>
<?php show_title($subtitle); ?>
<?php if (!$load_station && $load_stop) { ?>
<div class="grid-container">
	<div class="grid-x grid_padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			<?php open_form('addedit_stops.php', ((isset($st_id)) ? '?st_id=' . $st_id : '')); ?>
<!-- Description -->
				<label for="txt_descript">Description
					<input type="text" name="txt_descript" id="txt_descript" placeholder="Describe this stop" required >
					<span class="form-error">
						Please enter the description for this Stop ...
					</span>
				</label>
<!-- Address -->
				<label for="txt_address">Address
					<input type="text" name="txt_address" id="txt_address" placeholder="Cross street or closest address" required >
					<span class="form-error">
						Please enter the closest cross street or street address for this stop ...
					</span>
				</label>
<!-- Stop-Time -->
				<label for="num_stop_time">Trolly Stop Time
					<input type="number" name="num_stop_time" id="num_stop_time" step="5" min="00" max="55" value="00" required >
					<span class="form-error">
						Please choose a time when the trolly will stop ...
					</span>
				</label>
<!-- Shelter -->
				<label for="select_shelter">Does this stop have a trolly shelter?
					<select name="select_shelter" id="select_shelter" required>
						<option value="">Choose Yes or No</option>
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
					<span class="form-error">
						Please choose Yes or No ...
					</span>
				</label>
<!-- Direction -->
				<label for="">Direction
					<select name="select_direction" id="select_directio" required>
						<option value="">Choose Direction</option>
						<option value="Transfer">Transfer</option>
						<option value="East bound">East bound</option>
						<option value="West bound">West bound</option>
						<option value="North bound">North bound</option>
						<option value="South bound">South bound</option>
					</select>
					<span class="form-error">
						Please choose the direction the trolly is traveling when leaving this stop ...
					</span>
				</label>
				
				
				<div class="text-center">
					<?php get_submit_button('button_submit_stop', 'Save'); ?>
					<?php get_reset_button(); ?>
					<?php get_cancel_button(TROLLY . 'addedit_stops.php'); ?>
				</div>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>
<?php } elseif ($load_station && !$load_stop) { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			<?php open_form('addedit_stops.php'); ?>
				<label for="select_station">Choose the line
    				<select name="select_station" id="select_station" required>
    					<option value="">Choose line to add stop too</option>
    					<?php foreach ($station as $st) { ?>
    					<option value="<?php echo $st->st_id; ?>"><?php echo $st->line . ' ' . $st->start_time . ' ' . $st->end_time . ' ' . $st->end; ?></option>
    					<?php } ?>
    				</select>
    				<span class="form-error">
    					Please choose the Station that you would like to add a stop too ...
    				</span>
				</label>
				
				<div class="text-center">
    				<?php get_submit_button('button_submit_station', 'Get it'); ?>
    				<?php get_cancel_button('addedit_stops.php'); ?>
				</div>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>
<?php } elseif ($load_station && $load_stop) { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			<?php open_form('addedit_stops.php'); ?>
				
				<label for="">Choose the Stop to Edit
					<select name="select_edit_stop" id="select_edit_stop" required>
						<option value="">Choose Stop to edit or Add New Stop</option>
						<option value="new">Add New Stop</option>
						
					</select>
				</label>
				<div class="text-center">
    				<?php get_submit_button('button_submit_edit_stops', 'Get it'); ?>
    				<?php get_cancel_button('addedit_stops.php'); ?>
				</div>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>
<?php } ?>
<?php include_layout_template('jcs_footer.php'); ?>



