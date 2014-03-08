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
        <div class="btn btn-block btn-default bold">
            <span class="glyphicon french_press"></span> Resturant Name
        </div>
        <div class="btn btn-block btn-default bold">
            <span class="glyphicon french_press"></span> Resturant Name
        </div>
    </div>

<?php
// Render Footer
$thisPage->renderView('footer');
?>