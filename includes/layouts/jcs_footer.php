<!-- Footer -->
<div class="italic text-center">
			<?php for ($x = 0; $x < 0; $x++) { ?>
				<br>
			<?php } ?>
			<hr>
	<footer>
		<small>Copyright &copy; <?php echo date('Y'); echo " " . CO_NAME; ?>  All Rights Reserved!</small>
	</footer>
	<div class="text-center">
		<img alt="<?php echo CO_ABBR; ?>" src="<?php echo MEDIA . CO_ICO; ?>">
	</div>
	<hr>
</div>
<script src="<?php echo JS_PATH . "vendor/jquery.js"; ?>"></script>
<script src="<?php echo JS_PATH . "vendor/what-input.js"; ?>"></script>
<script src="<?php echo JS_PATH . "vendor/foundation.js"; ?>"></script>
<script src="<?php echo JS_PATH . "app.js"; ?>"></script>
<script>
	$(document).foundation();
</script>
</body>
</html>
<!-- Footer: END -->
<?php
if (isset($base)) {
    $base->db_close();
}
?>
