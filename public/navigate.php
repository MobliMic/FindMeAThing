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
	<div id="directions-panel" class="col-md-6"></div>
	<div id="map-canvas" class="col-md-6"></div>
<?php
// Render Footer
$thisPage->renderView('footer');
?>