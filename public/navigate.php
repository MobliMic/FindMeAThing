<?php
require_once('../.core/core.class.php');
$pageSettings = [
    'views' => [
        'header' => [
            'pageName' => 'Navigate',
            'sass' => ['main' => true, 'navigate' => true],
            'js' => ['main' => true, 'navigate' => true]
        ],
        'body' => true,
        'footer' => true
    ],
    'forms' => true
];
$thisPage = new HC_Page($pageSettings);

// Render Header
$thisPage->renderView('header');
?>
	<div class="row">
		<div class="col-md-6">
			<div id="directions-panel"></div>
		</div>
		<div class="col-md-6">
			<div id="map-canvas"></div>
		</div>
	</div>


<?php
// Render Footer
$thisPage->renderView('footer');
?>