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
		<div class="alert" style="display: none;" id="warning">
			<p><strong>Warning!</strong> <span id="warningText"></span></p>
		</div>
	</div>
	<div class="row">
		<select id="mode" onchange="reCalcMap();" class="form-control">
			<option value="DRIVING" selected>Driving</option>
			<option value="WALKING">Walking</option>
			<option value="BICYCLING">Bicycling</option>
			<option value="TRANSIT">Transit</option>
		</select>
		<br>
	</div>
    <div class="row">
        <div class="col-md-6">
            <div id="directions-panel"></div>
        </div>
        <div class="col-md-6">
            <div id="map-canvas"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div id="compass"><span id="alpha">0</span> <br> <span id="beta">0</span> <br> <span id="gamma">0</span> <br> <span id="heading">0</span></div>
        </div>
    </div>


<?php
// Render Footer
$thisPage->renderView('footer');
?>