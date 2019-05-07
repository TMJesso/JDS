<?php
require_once '../../includes/initialize.php';
$subtitle = "Main Menu";
?>
<!-- Header -->
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>JCS :: Systems</title>
<link rel="stylesheet"
	href="<?php echo CSS_PATH . "foundation.min.css"; ?>">
<link rel="stylesheet" href="<?php echo CSS_PATH . "app.css"; ?>">
</head>
<body>
	<!-- Title Page -->
	<div class="grid-containter">
		<div class="large-12 medium-12 cell text-center">
			<h1>Jessop Computer Services</h1>
		</div>
		<div class="grid-x grid-padding-x">
			<div class="large-3 medium-3 ">&nbsp;</div>
			<div class="large-6 medium-6 cell text-center">
					<?php if (isset($subtitle)) { ?>
					<h4><?php echo $subtitle; ?></h4>
					<?php } ?>
					
			</div>
			<div class="large-3 medium-3 cell">&nbsp;</div>
		</div>
	</div>
	<!-- Title Page: END -->
	<!-- Menu -->
	<div class="grid-container">
		<div class="top-bar">
			<div class="top-bar-title" data-responsive-toggle="main-menu" data-hide-for="medium">
				<button class="menu-icon" type="button" data-toggle></button>
				&nbsp;<strong>Menu7</strong>
			</div>
			<div id="main-menu">
				<div class="top-bar-left">
					<ul class="dropdown vertical medium-horizontal menu"
						data-responsive-menu="drilldown medium-dropdown"
						data-auto-height="true" data-animate-height="true">
						<li><a href="#">One</a>
							<ul class="menu">
								<li><a href="#">One</a>
									<ul class="menu">
										<li><a href="#">Alpha</a></li>
										<li><a href="#">Beta</a>
											<ul class="menu">
												<li><a href="#">Boyz</a></li>
												<li><a href="#">Girlz</a></li>
												<li><a href="#">None</a></li>
											</ul>
										</li>
										<li><a href="#">Cat</a></li>
									</ul>
								</li>
								<li><a href="#">Two</a></li>
								<li><a href="#">Three</a>
									<ul class="menu">
										<li><a href="#">One</a></li>
										<li><a href="#">Two</a></li>
										<li><a href="#">Three</a>
											<ul class="menu">
												<li><a href="#">One</a></li>
												<li><a href="#">Two</a></li>
												<li><a href="#">Three</a></li>
											</ul></li>
									</ul></li>
								</ul>
							</li>
						<li><a href="#">Two</a></li>
						<li><a href="/JCS/public/admin/index.php">JCS</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="large-3 medium-3 cell">&nbsp;</div>
			<div class="large-6 medium-6 text-center cell">
				<?php echo output_message($session->message); ?>
				<?php echo output_errors($session->err); ?>
			</div>
			<div class="large-3 medium-3 cell">&nbsp;</div>
		</div>
	</div>
	<!-- Header: END -->
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="large-3 medium-3 cell">&nbsp;</div>
			<div class="large-6 medium-6 cell">
				<div class="text-center">
					This is the contents
				</div>
			</div>
			<div class="large-3 medium-3 cell">&nbsp;</div>
		</div>
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