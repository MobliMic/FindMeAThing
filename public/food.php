<?php
require_once('../.core/core.class.php');
$pageSettings = [
    'views' => [
        'header' => [
            'pageName' => 'Food',
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

    <div class="row">
        <a href="food/summary.php?name=Super%20Cool%20NomNom%20Place" class="btn btn-block btn-default text-left">
            Restaurant Name
            <br>
            Type - 500m
                <span class="pull-right glyphicons star"></span>
                <span class="pull-right glyphicons star"></span>
                <span class="pull-right glyphicons star"></span>
                <span class="pull-right glyphicons star"></span>
        </a>

        <div class="btn btn-block btn-default text-left">
            Restaurant Name
            <br>
            Type - 500m
                <span class="pull-right glyphicons star"></span>
                <span class="pull-right glyphicons star"></span>
        </div>

        <div class="btn btn-block btn-default text-left">
            Restaurant Name
            <br>
            Type - 500m
                <span class="pull-right glyphicons star"></span>
        </div>

        <div class="btn btn-block btn-default text-left">
            Restaurant Name
            <br>
            Type - 500m
                <span class="pull-right glyphicons star"></span>
                <span class="pull-right glyphicons star"></span>
                <span class="pull-right glyphicons star"></span>
        </div>
    </div>

<?php
// Render Footer
$thisPage->renderView('footer');
?>