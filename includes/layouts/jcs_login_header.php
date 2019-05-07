<?php
global $session, $thisPage;
//$menu_type = Menu_Type::get_by_type(CO_ABBR, 9);
?>
<!-- Header -->
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo MEDIA.CO_ICO; ?>" rel="icon" />

<title><?php echo CO_ABBR; ?> :: Systems</title>
<link rel="stylesheet"
	href="<?php echo CSS_PATH . "foundation.min.css"; ?>">
<link rel="stylesheet" href="<?php echo CSS_PATH . "app.css"; ?>">
</head>
<body>
	<!-- Title Page -->
	<div class="grid-containter">
		<div class="grid-x grid-padding-x">
			<div class="large-12 medium-12 cell text-center">
				<img alt="<?php echo CO_ABBR; ?>" width="25" height="25" src="<?php echo MEDIA . CO_GIF?>">
				<h1><?php echo CO_NAME; ?></h1>

			</div>
		</div>
	</div>
	<!-- Title Page: END -->
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="large-3 medium-3 cell">&nbsp;</div>
			<div class="large-6 medium-6 text-center cell">
				<?php if (isset($thisPage)) { ?>
				<h3 class="text-center"><?php  echo $thisPage; ?></h3>
				<?php } ?>
				<?php echo output_message($session->message); ?>
				<?php echo output_errors($session->err); ?>
			</div>
			<div class="large-3 medium-3 cell">&nbsp;</div>
		</div>
	</div>
	<!-- Header: END -->