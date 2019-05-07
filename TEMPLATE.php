<?php
require_once 'includes/initialize.php';

$subtitle = "TEMPLATE";
?>
<?php include_layout_template('jcs_login_header.php'); // use jcs_header.php to include menus  ?>
<!-- html content goes below here -->
<div class="grid-container">
	<div class="grid-x gird-padding-x">
		<div class="large-12 medium-12 cell"> <!-- this will produce a 12 column grid and should not ever be more than 12 -->
    		<!-- remove all this text before adding your html -->
    		This is test and will show as html
    		you can put 
    		<h1 class="text-center">heading 1</h1>
    		 here
    		
    		<p>Or you can put paragraphs here also</p>
		
		
		</div>
	</div>
</div>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			<!-- if you need a form use this template -->
			<form data-abide novalidate method="post" action="login.php">
				<div data-abide-error class="alert callout" style="display: none;">
					<p>
						<i class="fi-alert"></i> Please scroll down to view all errors on form if necessary.
					</p>
				</div>
				<label for="txt_template_id">Template Box
					<input type="text" name="text_template" id="txt_template_id" maxlength="25" value="" placeholder="Maximum of 25 characters" required>
					<span class="form-error">
						You must enter text in this template box
					</span>
				</label>
			
				<div class="text-center">
					<input type="submit" name="submit_template" id="submit_template" class="button" value="Submit" >
				</div>
			</form>
		
		</div>
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
	</div>
</div>

<!-- html content goes above here -->
<?php include_layout_template('jcs_footer.php'); ?>


