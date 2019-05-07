<?php
require_once '../../includes/initialize.php';

$values = Yekym::get_all_data();
$headings = array();
foreach ($values as $key) {
    $newvalues = $key->get_headings();
    break;
}
for ($x = 2; $x < count($newvalues); $x++) {
    $headings[] = $newvalues[$x];
}
// foreach ($headings as $head) {
//     echo $head . " :: " . chr($head) . "<br>";
// }
// return;
?>
<?php include_layout_template('jcs_header.php'); ?>
<div class="grid-containter">
	<div class="grid-x grid-padding-x">
		<div class="large-12 medium-12">
			<table>
				<tr>
					<th>Letter</th>
			<?php foreach ($headings as $key=>$head) { ?>
					<th><?php echo chr($head);?>(key)</th>
					<?php if ($key >= 28) { break; } ?>
			<?php } ?>
				</tr>
<?php foreach ($values as $key) { ?>
				<tr>
					<td><?php echo chr($key->col_letter); ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l33) . "(". $key->convert_from_table_to_value($key->l33) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l35) . "(". $key->convert_from_table_to_value($key->l35) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l36) . "(". $key->convert_from_table_to_value($key->l36) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l37) . "(". $key->convert_from_table_to_value($key->l37) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l38) . "(". $key->convert_from_table_to_value($key->l38) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l40) . "(". $key->convert_from_table_to_value($key->l40) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l41) . "(". $key->convert_from_table_to_value($key->l41) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l42) . "(". $key->convert_from_table_to_value($key->l42) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l44) . "(". $key->convert_from_table_to_value($key->l44) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l45) . "(". $key->convert_from_table_to_value($key->l45) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l46) . "(". $key->convert_from_table_to_value($key->l46) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l47) . "(". $key->convert_from_table_to_value($key->l47) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l48) . "(". $key->convert_from_table_to_value($key->l48) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l49) . "(". $key->convert_from_table_to_value($key->l49) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l50) . "(". $key->convert_from_table_to_value($key->l50) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l51) . "(". $key->convert_from_table_to_value($key->l51) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l52) . "(". $key->convert_from_table_to_value($key->l52) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l53) . "(". $key->convert_from_table_to_value($key->l53) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l54) . "(". $key->convert_from_table_to_value($key->l54) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l55) . "(". $key->convert_from_table_to_value($key->l55) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l56) . "(". $key->convert_from_table_to_value($key->l56) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l57) . "(". $key->convert_from_table_to_value($key->l57) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l58) . "(". $key->convert_from_table_to_value($key->l58) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l59) . "(". $key->convert_from_table_to_value($key->l59) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l60) . "(". $key->convert_from_table_to_value($key->l60) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l61) . "(". $key->convert_from_table_to_value($key->l61) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l62) . "(". $key->convert_from_table_to_value($key->l62) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l63) . "(". $key->convert_from_table_to_value($key->l63) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l64) . "(". $key->convert_from_table_to_value($key->l64) . ")"; ?></td>
				</tr>
<?php } ?>
			</table>
			<br><br><br>
			<table>
				<tr>
					<th>Letter</th>
			<?php foreach ($headings as $key=>$head) { ?>
					<?php if ($key >28) {?>
					<th><?php echo chr($head);?>(key)</th>
					<?php if ($key >= (57)) { break; } ?>
					<?php }?>
			<?php } ?>
				</tr>
<?php foreach ($values as $key) { ?>
				<tr>
					<td><?php echo chr($key->col_letter); ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l65) . "(". $key->convert_from_table_to_value($key->l65) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l66) . "(". $key->convert_from_table_to_value($key->l66) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l67) . "(". $key->convert_from_table_to_value($key->l67) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l68) . "(". $key->convert_from_table_to_value($key->l68) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l69) . "(". $key->convert_from_table_to_value($key->l69) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l70) . "(". $key->convert_from_table_to_value($key->l70) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l71) . "(". $key->convert_from_table_to_value($key->l71) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l72) . "(". $key->convert_from_table_to_value($key->l72) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l73) . "(". $key->convert_from_table_to_value($key->l73) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l74) . "(". $key->convert_from_table_to_value($key->l74) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l75) . "(". $key->convert_from_table_to_value($key->l75) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l76) . "(". $key->convert_from_table_to_value($key->l76) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l77) . "(". $key->convert_from_table_to_value($key->l77) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l78) . "(". $key->convert_from_table_to_value($key->l78) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l79) . "(". $key->convert_from_table_to_value($key->l79) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l80) . "(". $key->convert_from_table_to_value($key->l80) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l81) . "(". $key->convert_from_table_to_value($key->l81) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l82) . "(". $key->convert_from_table_to_value($key->l82) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l83) . "(". $key->convert_from_table_to_value($key->l83) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l84) . "(". $key->convert_from_table_to_value($key->l84) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l85) . "(". $key->convert_from_table_to_value($key->l85) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l86) . "(". $key->convert_from_table_to_value($key->l86) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l87) . "(". $key->convert_from_table_to_value($key->l87) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l88) . "(". $key->convert_from_table_to_value($key->l88) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l89) . "(". $key->convert_from_table_to_value($key->l89) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l90) . "(". $key->convert_from_table_to_value($key->l90) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l91) . "(". $key->convert_from_table_to_value($key->l91) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l92) . "(". $key->convert_from_table_to_value($key->l92) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l93) . "(". $key->convert_from_table_to_value($key->l93) . ")"; ?></td>
				</tr>
<?php } ?>
			</table>
			<br><br><br>
			<table>
				<tr>
					<th>Letter</th>
			<?php foreach ($headings as $key=>$head) { ?>
					<?php if ($key >57) {?>
					<th><?php echo chr($head);?>(key)</th>
					<?php }?>
			<?php } ?>
				</tr>
<?php foreach ($values as $key) { ?>
				<tr>
					<td><?php echo chr($key->col_letter); ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l94) . "(". $key->convert_from_table_to_value($key->l94) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l97) . "(". $key->convert_from_table_to_value($key->l97) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l98) . "(". $key->convert_from_table_to_value($key->l98) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l99) . "(". $key->convert_from_table_to_value($key->l99) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l100) . "(". $key->convert_from_table_to_value($key->l100) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l101) . "(". $key->convert_from_table_to_value($key->l101) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l102) . "(". $key->convert_from_table_to_value($key->l102) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l103) . "(". $key->convert_from_table_to_value($key->l103) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l104) . "(". $key->convert_from_table_to_value($key->l104) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l105) . "(". $key->convert_from_table_to_value($key->l105) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l106) . "(". $key->convert_from_table_to_value($key->l106) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l107) . "(". $key->convert_from_table_to_value($key->l107) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l108) . "(". $key->convert_from_table_to_value($key->l108) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l109) . "(". $key->convert_from_table_to_value($key->l109) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l110) . "(". $key->convert_from_table_to_value($key->l110) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l111) . "(". $key->convert_from_table_to_value($key->l111) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l112) . "(". $key->convert_from_table_to_value($key->l112) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l113) . "(". $key->convert_from_table_to_value($key->l113) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l114) . "(". $key->convert_from_table_to_value($key->l114) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l115) . "(". $key->convert_from_table_to_value($key->l115) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l116) . "(". $key->convert_from_table_to_value($key->l116) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l117) . "(". $key->convert_from_table_to_value($key->l117) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l118) . "(". $key->convert_from_table_to_value($key->l118) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l119) . "(". $key->convert_from_table_to_value($key->l119) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l120) . "(". $key->convert_from_table_to_value($key->l120) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l121) . "(". $key->convert_from_table_to_value($key->l121) . ")"; ?></td>
					<td><?php echo $key->convert_from_hex_to_char($key->l122) . "(". $key->convert_from_table_to_value($key->l122) . ")"; ?></td>
				</tr>
<?php } ?>
			</table>
		</div>
	</div>
</div>


<?php include_layout_template('jcs_footer.php'); ?>

