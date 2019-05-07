<?php
require_once '../../includes/initialize.php';
require_once '../../includes/tables.php';




?>
<?php include_layout_template('jcs_header.php'); ?>
<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		<div class="large-6 medium-6 cell">
			<?php testing(); ?>
			All Tables have been created and populated....
			
		</div>	
		<div class="large-3 medium-3 cell">
			&nbsp;
		</div>
		
	</div>
</div>


<?php include_layout_template('jcs_footer.php'); ?>
<?php 

function testing() {
    $user = User::generate_table_and_data() . "<br>";
    $menu_type = Menu_Type::generate_table_and_data() . "<br>";
    $menu = Menu::generate_table_and_data() . "<br>";
    $tier1 = Tier1::generate_table_and_data() . "<br>";
    $tier2 = Tier2::generate_table_and_data() . "<br>";
    $details = User_Detail::generate_table_and_data() . "<br>";
    $yekym = Yekym::generate_table_and_data() . "<br>";
    $login = Login::generate_table_and_data() . "<br>";
    $unpw = UnPw::generate_table_and_data() . "<br>";
    $codes = Codes::generate_table_and_data() . "<br>";
    $message  = $user;
    $message .= $menu_type;
    $message .= $menu;
    $message .= $tier1;
    $message .= $tier2;
    $message .= $details;
    $message .= $yekym;
    $message .= $login;
    $message .= $unpw;
    $message .= $codes;
    
    echo $message;
}

?>

