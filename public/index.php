<?php
require_once('../.core/core.class.php');
$pageSettings = [
    'views' => [
        'header' => [
            'pageName' => 'Home',
            'sass' => ['main' => true],
            'js' => ['main' => true]
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

    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <span class="glyphicons-icon fast_food"></span>

                <h2>Things</h2>
            </div>

            <div class="col-md-3">
                <span class="glyphicons-icon fast_food"></span>

                <h2>Things</h2>
            </div>

            <div class="col-md-3">
                <span class="glyphicons-icon fast_food"></span>

                <h2>Things</h2>
            </div>

            <div class="col-md-3">
                <span class="glyphicons-icon fast_food"></span>

                <h2>Things</h2>
            </div>

        </div>
    </div>


<?php
// Render Footer
$thisPage->renderView('footer');
?>