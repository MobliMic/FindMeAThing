<?php
	if (isset($viewSettings['pageName'])) {
		$pageName = SITE_NAME . ' - ' . $viewSettings['pageName'];
	} else {
		$pageName = SITE_NAME;
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $pageName; ?></title>
	<link rel="shortcut icon" href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/favicon.ico" type="image/icon">
	<link rel="icon" href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/favicon.ico" type="image/icon">
	<meta name="viewport"
	      content="width=device-width, height=device-height, initial-scale=1, user-scalable=no, target-densitydpi=device-dpi">
	<?php

		// Get the resource path
		$siteSettings = $GLOBALS['HC_CORE']->getSite()->getSettings();
		if (isset($siteSettings['compilation'])) {
			if (isset($siteSettings['compilation']['path'])) {
				$resourcePath = $siteSettings['compilation']['path'];
			} else {
				$resourcePath = '/resources/';
			}
		} else {
			$resourcePath = '/resources/';
		}

		// If this page uses sass
		if (isset($viewSettings['sass'])) {
			// Link the resoucres
			foreach ($viewSettings['sass'] as $row => $value) {
				echo '<link rel="stylesheet" type="text/css" href="' . PROTOCOL . '://' . SITE_DOMAIN . $resourcePath . 'scss/' . $row . '.scss.css">' . PHP_EOL;
			}
		}
		// If this page uses less
		if (isset($viewSettings['less'])) {
			// Link the resoucres
			foreach ($viewSettings['less'] as $row => $value) {
				echo '<link rel="stylesheet" type="text/css" href="' . PROTOCOL . '://' . SITE_DOMAIN . $resourcePath . 'less/' . $row . '.less.css">' . PHP_EOL;
			}
		}
		// If this page uses js
		if (isset($viewSettings['js'])) {
			// Link the resoucres
			foreach ($viewSettings['js'] as $row => $value) {
				echo '<script src="' . PROTOCOL . '://' . SITE_DOMAIN . $resourcePath . 'js/' . $row . '.closure.js"></script>' . PHP_EOL;
			}
		}
		// If this page uses dart
		if (isset($viewSettings['dart'])) {
			// Link the resoucres
			foreach ($viewSettings['dart'] as $row => $value) {
				echo '<script src="' . PROTOCOL . '://' . SITE_DOMAIN . $resourcePath . 'dart/' . $row . '.dart.js"></script>' . PHP_EOL;
			}
		}
	?>
	<meta property="og:title" content="<?php echo $pageName; ?>">
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>">
	<meta property="og:image" content="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/favicon.png">
	<!--[if lt IE 9]>
	<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="https://raw2.github.com/scottjehl/Respond/master/src/respond.js"></script>
	<![endif]-->
</head>
<body>
<header>
	<nav class="clear">
		<ul role="list">
			<li role="listitem"><a href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>">Home</a></li>
		</ul>
	</nav>
</header>
<div class="clear"></div>
<section id="page">