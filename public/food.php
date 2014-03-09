<?php
require_once('../.core/core.class.php');
$pageSettings = [
    'views' => [
        'header' => [
            'pageName' => 'Food',
            'sass' => ['main' => true],
            'js' => [
                'main' => true,
                'navigate' => true,
                'food' => true,
                'ajax' => true
            ]
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

    <div class="row" id="locationContainer">

    </div>

    <!--<div class="row">
        <a href="food/summary.php?name=Super%20Cool%20NomNom%20Place" class="btn btn-block btn-default text-left">
            Restaurant Name
            <br>
            30m -
            <span class="glyphicons star"></span>
            <span class="glyphicons star"></span>
            <span class="glyphicons star"></span>
        </a>

        <a href="food/summary.php?name=Ryans%20House" class="btn btn-block btn-default text-left">
            Restaurant Name
            <br>
            143m -
            <span class="glyphicons star"></span>
        </a>

        <a href="food/summary.php?name=lololol" class="btn btn-block btn-default text-left">
            Restaurant Name
            <br>
            1000m -
            <span class="glyphicons star"></span>
            <span class="glyphicons star"></span>
            <span class="glyphicons star"></span>
            <span class="glyphicons star"></span>
        </a>

        <a href="food/summary.php?name=Michael%20Is%20So%20Cool" class="btn btn-block btn-default text-left">
            Restaurant Name
            <br>
            40,000m -
            <span class="glyphicons star"></span>
            <span class="glyphicons star"></span>
        </a>
    </div>-->

<?php
// Render Footer
$thisPage->renderView('footer');
?>