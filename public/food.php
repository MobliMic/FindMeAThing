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
        <div class="btn btn-block btn-default">
            <span class="glyphicon french_press pull-left"></span>
            Restaurant Name
            <br>
            Type - 500m
            <div>
                <span class="pull-right glyphicon star"></span>
                <span class="pull-right glyphicon star"></span>
                <span class="pull-right glyphicon star"></span>
                <span class="pull-right glyphicon star"></span>
                <span class="pull-right glyphicon star-empty"></span>
            </div>
        </div>

        <div class="btn btn-block btn-default">
            <span class="glyphicon french_press pull-left"></span>
            Restaurant Name
            <br>
            Type - 500m
            <div>
                <span class="pull-right glyphicon star"></span>
                <span class="pull-right glyphicon star"></span>
                <span class="pull-right glyphicon star-empty"></span>
                <span class="pull-right glyphicon star-empty"></span>
                <span class="pull-right glyphicon star-empty"></span>
            </div>
        </div>

        <div class="btn btn-block btn-default">
            <span class="glyphicon french_press pull-left"></span>
            Restaurant Name
            <br>
            Type - 500m
            <div>
                <span class="pull-right glyphicon star"></span>
                <span class="pull-right glyphicon star-empty"></span>
                <span class="pull-right glyphicon star-empty"></span>
                <span class="pull-right glyphicon star-empty"></span>
                <span class="pull-right glyphicon star-empty"></span>
            </div>
        </div>

        <div class="btn btn-block btn-default">
            <span class="glyphicon french_press pull-left"></span>
            Restaurant Name
            <br>
            Type - 500m
            <div>
                <span class="pull-right glyphicon star"></span>
                <span class="pull-right glyphicon star"></span>
                <span class="pull-right glyphicon star"></span>
                <span class="pull-right glyphicon star-empty"></span>
                <span class="pull-right glyphicon star-empty"></span>
            </div>
        </div>
    </div>

<?php
// Render Footer
$thisPage->renderView('footer');
?>