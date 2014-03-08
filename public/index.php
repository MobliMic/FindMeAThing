<?php
	require_once('../.core/core.class.php');
	$pageSettings = [
		'views' => [
			'header' => [
				'pageName' => 'Home',
				'sass'     => ['main' => true],
				'js'       => ['main' => true]
			],
			'body'   => true,
			'footer' => true
		],
		'forms' => true
	];
	$thisPage = new HC_Page($pageSettings);

	// Render Header
	$thisPage->renderView('header');
?>
	<h1>HydraCore</h1>
<?php
	// Render Footer
	$thisPage->renderView('footer');
?>