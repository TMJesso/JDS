<?php
// personal
require_once '../../../../includes/initialize.php';

?>
<?php include_layout_template(LIB_PATH . 'jcs_header.php'); ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			<?php open_form(RESUME.'personal.php'); ?>
			
			<div class="text-center">
				<input type="submit" class="button" name="submit_person" id="submit_person" value="submit">
				<input type="reset" class="button" name="submit_reset" id="submit_reset" value="Reset">
				<a href="<?php echo RESUME."personal.php"; ?>" class="button">Cancel</a>
			</div>
			<?php close_form(); ?>
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>


<?php include_layout_template(LIB_PATH . 'jcs_footer.php'); ?>

