<?php
require_once '../../../../includes/initialize.php';
if (!$session->is_logged_in()) { redirect_to(ADMIN_PATH.'login.php'); }
$menu_type = Menu_Type::get_by_type("Trolley", 9);

$subtitle = 'Add / Edit Stations';
$adding = true;
$load_choice = true;
$station = Station::get_all_stations_by_line();
if (isset($_POST['button_submit'])) {
    if (isset($_GET['sid'])) { 
        $adding = false;
        $st_id = $base->prevent_injection(hent($_GET['sid']));
        $station = Station::get_station_by_id($st_id);
        $station->line = $_POST['select_line'];
        $station->start_time = $_POST['hour_start_trip'] . ":" . $_POST['minute_start_trip'];
        $station->end_time = $_POST['hour_last_trip'] . ":" . $_POST['minute_last_trip'];
        $station->end = $_POST['hour_end_day'] . ":" . $_POST['minute_end_day'];
        if ($station->save()) {
            $session->message('Line (' . $station->line . ') was successfully saved!');
            redirect_to('addedit_station.php');
        } else {
            $errors = array("Edit Line"=>"Error occured saving the edited Line ({$station->line})");
            $session->errors($errors);
            redirect_to('addedit_station');
        }
    } else {
        $station = new Station();
        $station->st_id = get_new_id();
        $station->line = $_POST['select_line'];
        $station->start_time = $_POST['hour_start_trip'] . ":" . $_POST['minute_start_trip'];
        $station->end_time = $_POST['hour_last_trip'] . ":" . $_POST['minute_last_trip'];
        $station->end = $_POST['hour_end_day'] . ":" . $_POST['minute_end_day'];
        if ($station->save()) {
            $session->message('New line (' . $station->line . ') was successfully added!');
            redirect_to('addedit_station.php');
        } else {
            $errors = array("New Line"=>"Error occured saving new line ({$station->line})");
            $session->errors($errors);
            redirect_to('addedit_station.php');
        }
    }
} elseif (isset($_POST['submit_station'])) {
    $load_choice = false;
    if ($_POST['select_station'] === 'new') {
        $adding = true;
        $station = new Station();
        $stations = Station::get_all_stations_by_line();
        
    } else {
        $adding = false;
        $st_id = $_POST['select_station'];
        $station = Station::get_station_by_id($st_id);
    }
}

?>
<?php include_layout_template('jcs_header.php'); ?>
<?php show_title($subtitle); ?>
<?php if ($load_choice) { ?>
<div class="grid-containter">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			<?php open_form('addedit_station.php'); ?>
				<label for="select_station">
					<select name="select_station" id="select_station" required>
						<option value="">Choose which Line to edit</option>
						<option value="new">Add new line</option>
						<?php foreach ($station as $line) { ?>
						<option value="<?php echo $line->st_id; ?>"><?php echo $line->line; ?></option>
						<?php } ?>
					</select>
				</label>
				<div class="text-center">
					<?php get_submit_button('submit_station', 'Get it'); ?>
					<?php get_cancel_button('addedit_station.php'); ?>
				</div>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>
<?php } else { ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="Large-6 medium-6 cell">
			<?php open_form('addedit_station.php', (is_null($station->id)) ? '' : '?sid='.$station->st_id); ?>
<!-- Line -->
				<label for="select_line">Line
					<select name="select_line" id="select_line" required <?php if (!$adding) { ?> <?php } ?>>
						<option value="">Select a Line to <?php if ($adding) { ?>Add<?php } else { ?>Edit<?php } ?></option>
						<option value="Blue"<?php if ($station->line == "Blue") { ?> selected<?php } ?>>Blue</option>
						<option value="Green"<?php if ($station->line == "Green") { ?> selected<?php } ?>>Green</option>
						<option value="Orange"<?php if ($station->line == "Orange") { ?> selected<?php } ?>>Orange</option>
						<option value="Red"<?php if ($station->line == "Red") { ?> selected<?php } ?>>Red</option>
						<option value="Yellow"<?php if ($station->line == "Yellow") { ?> selected<?php } ?>>Yellow</option>
					</select>
					<span class="form-error">
						Please choose Red, Blue, Orange, Green or Yellow ...
					</span>
				</label>
<!-- Start Time -->
					<fieldset class="callout">
						<legend>1<sup>st</sup> trip of the day</legend>
					<?php get_time('hour_start_trip', 'minute_start_trip', strftime("%H", strtotime($station->start_time)), strftime("%M", strtotime($station->start_time))); ?>
					</fieldset>
<!-- Last Trip -->
					<fieldset class="callout">
						<legend>Last trip of the day</legend>
					<?php get_time('hour_last_trip', 'minute_last_trip', strftime("%H", strtotime($station->end_time)), strftime("%M", strtotime($station->end_time))); ?>
					</fieldset>
<!-- End of day -->
					<fieldset class="callout">
						<legend>Time this line ends at transfer station</legend>
						<?php get_time('hour_end_day', 'minute_end_day', strftime("%H", strtotime($station->end)), strftime("%M", strtotime($station->end))); ?>
					</fieldset>
			
				<div class="text-center">
    				<?php get_submit_button('button_submit', (is_null($station->id)) ? 'Save' : 'Edit'); ?>
    				<?php get_reset_button(); ?>
    				<?php get_cancel_button('addedit_station.php'); ?>
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


<?php 
function get_formated_time($hour) {
    if ($hour < 10) {
        return "0" . $hour;
    }
    return $hour;
}

function get_time($hvar, $mvar, $hr, $mn) {
    ?>
    					<div class="grid-container">
						<div class="grid-x grid-padding-x">
							<div class="large-6 medium-6 cell">
                 				<label>Hour
               						<select name="<?php echo $hvar; ?>" id="<?php echo $hvar; ?>" required>
                						<option value="">Choose the hour</option>
                						<?php for ($h = 0; $h <= 23; $h++) { ?>
                						<option value="<?php echo get_formated_time($h); ?>"<?php if ($hr == get_formated_time($h) ) { ?> selected <?php } ?>><?php echo get_formated_time($h); ?></option>
                						<?php } ?>
                					</select>
                					<span class="form-error">
                						Please choose the hour ... 
                					</span>
                				</label>
							</div>
							<div class="large-6 medium-6 cell">
                  				<label>Minute
	              					<select name="<?php echo $mvar; ?>" id="<?php echo $mvar; ?>" required>
                						<option value="">Choose the minute</option>
                						<?php for ($m = 0; $m <= 59; $m++) { ?>
                						<option value="<?php echo get_formated_time($m); ?>"<?php if ($mn == get_formated_time($m)) { ?> selected <?php } ?>><?php echo get_formated_time($m); ?></option>
                						<?php } ?>
                					</select>
                					<span class="form-error">
                						Please choose the minutes ... 
                					</span>
                				</label>
							</div>
						</div>
					</div>
    
    <?php 
}
?>

